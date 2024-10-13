<?php

namespace App\Http\Livewire\Catalogo;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Comunidad;
use App\Models\Reseña;
use App\Models\Promocion;
use Livewire\WithPagination;

class ProductoCatalogo extends Component
{   
    use WithPagination;
    public $search = '';
    public $selectedCategory = '';
    public $selectedCommunity = ''; // Nueva propiedad para la comunidad seleccionada

    public function render()
    {
        $categories = Categoria::all(); 
        $communities = Comunidad::all(); 
        $reseñas = Reseña::all(); 

        // Obtener productos filtrados por nombre, categoría seleccionada y comunidad seleccionada
        $products = Producto::with(['user', 'category', 'comunidad']) 
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')  // Filtro por nombre
                    ->orWhere('price', 'like', '%' . $this->search . '%')  // Filtro por precio
                    ->orWhere('description', 'like', '%' . $this->search . '%') // Filtro por descripción
                    ->orWhereHas('user', function ($q) {  // Filtro por nombre del usuario
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->when($this->selectedCommunity, function ($query) {
                $query->where('comunidad_id', $this->selectedCommunity); // Filtro por comunidad
            })
            ->paginate(12);  // Pagina los resultados

        return view('livewire.catalogo.producto-catalogo', [
            'products' => $products,
            'categories' => $categories,
            'communities' => $communities, 
            'reseñas' => $reseñas,
        ]);
    }
}
