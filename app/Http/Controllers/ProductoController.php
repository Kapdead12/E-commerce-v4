<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Comunidad;
use App\Models\Reseña;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    
    public function index()
    {
        $products = Auth::user()->productos;
        return view('productos.index', compact('products'));
    }

    public function indexPorUsuario()
    {
        // Obtiene los productos del usuario autenticado
        $products = Producto::where('user_id', Auth::id())->get(); 
        if ($products === null) {
            $products = []; 
        }
        return view('productos.index-Usuario', compact('products'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Categoria::all(); // Asegúrate de que tienes un modelo Categoria
        $communities = Comunidad::all(); // Asegúrate de que tienes un modelo Comunidad
        return view('productos.registro-Producto',compact('categories', 'communities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categorias,id',
            'comunidad_id' => 'required|exists:comunidades,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Las imágenes son opcionales
        ]);

        // Crear el producto utilizando la información validada y el user_id del usuario autenticado
        $producto = Producto::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'comunidad_id' => $request->comunidad_id,
        ]);

        // Manejo de las imágenes
        $imagePaths = []; // Array para almacenar las rutas de las imágenes

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Guardar cada imagen y obtener su ruta
                $path = $image->store('productos', 'public'); 
                $imagePaths[] = $path; // Agregar la ruta de la imagen al array
            }
        }

        // Almacenar el array de rutas de imágenes en formato JSON en el campo 'images' del producto
        if (count($imagePaths) > 0) {
            $producto->images = json_encode($imagePaths);
        } else {
            $producto->images = null; // O puedes dejarlo vacío o como un string vacío ""
        }
        
        $producto->save();

        return redirect()->route('productos.index-Usuario')->with('message', 'Producto creado con éxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Obtener el producto con las relaciones de user, category, y comunidad
        $product = Producto::with(['user', 'category', 'comunidad'])->findOrFail($id);

        // Decodificar las imágenes almacenadas en el campo JSON
        $images = json_decode($product->images);
        return view('productos.show', compact('product', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Producto::findOrFail($id);
        $images = $product->images ?? [];
        $users = User::all(); // Asegúrate de que tienes un modelo User
        $categories = Categoria::all(); // Asegúrate de que tienes un modelo Categoria
        $communities = Comunidad::all(); // Asegúrate de que tienes un modelo Comunidad

        return view('productos.edit', compact('product', 'images', 'users', 'categories', 'communities'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        try {
            $product = Producto::findOrFail($id);

            // Actualiza los detalles del producto
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->stock = $request->input('stock');
            $product->user_id = $request->input('user_id'); // Actualizar user_id
            $product->category_id = $request->input('category_id'); // Actualizar category_id
            $product->comunidad_id = $request->input('comunidad_id'); 

            // Manejo de imágenes
            $images = json_decode($product->images, true);

            // Eliminar imágenes seleccionadas
            if ($request->has('remove_images')) {
                foreach ($request->input('remove_images') as $imageToRemove) {
                    if (($key = array_search($imageToRemove, $images)) !== false) {
                        unset($images[$key]);
                        // Aquí puedes eliminar físicamente la imagen del almacenamiento si lo deseas
                    }
                }
            }

            // Manejo de nuevas imágenes
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    // Guarda la nueva imagen y agrega la ruta al arreglo
                    $path = $image->store('productos', 'public'); 
                    $images[] = $path;
                }
            }

            // Guarda las imágenes actualizadas en el producto
            $product->images = json_encode(array_values($images));
            $product->save();

            // Redirigir en caso de éxito
            return redirect()->route('productos.index-Usuario')->with('message', 'Producto actualizado con éxito.');

        } catch (\Exception $e) {
            // Redirigir en caso de error
            return redirect()->back()->withErrors(['message' => 'Hubo un error al actualizar el producto.']);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Producto::findOrFail($id); // Busca el producto por ID

        // Elimina las imágenes del producto (opcional)
        $images = json_decode($product->images);
        if ($images) {
            foreach ($images as $image) {
                // Elimina la imagen del almacenamiento
                \Storage::delete("public/productos/{$image}");
            }
        }

        $product->delete(); // Elimina el producto

        return redirect()->route('productos.index-Usuario')->with('message', 'Producto eliminado correctamente.');
    }
}
