<?php

namespace App\Http\Livewire\Promocion;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Comunidad;
use App\Models\Promocion;

class PromocionIndex extends Component
{   
    use WithPagination;
    public $search = '';
    public $selectedCategory = '';
    public $selectedCommunity = ''; // Nueva propiedad para la comunidad seleccionada

    /*public function render()
    {
        $categories = Categoria::all(); 
        $communities = Comunidad::all(); 

        // Obtener productos paginados, filtrando por nombre, categoría seleccionada y comunidad
        $products = Producto::with(['user', 'category', 'comunidad','promociones']) // Asegúrate de que la relación está definida en el modelo
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('price', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhereHas('user', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      });
            })
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->when($this->selectedCommunity, function ($query) {
                $query->where('comunidad_id', $this->selectedCommunity); // Filtrar por comunidad
            })
            ->paginate(4);

        return view('livewire.promocion.promocion-index', [
            'products' => $products,
            'categories' => $categories,
            'communities' => $communities, // Pasar comunidades a la vista
        ]);
    }*/

    public function render()
    {
        // Obtener promociones con productos relacionados, filtrando por búsqueda
        $promociones = Promocion::with('product')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%') // Buscar por nombre de promoción
                      ->orWhereHas('product', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%'); // Buscar por nombre de producto
                      });
            })
            ->paginate(5); // Cambia el número según sea necesario

        return view('livewire.promocion.promocion-index', [
            'promociones' => $promociones,
        ]);
    }
}
