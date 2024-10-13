<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Comunidad;

class ProductIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $selectedCategory = '';
    public $selectedCommunity = ''; // Nueva propiedad para la comunidad seleccionada

    public function render()
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

        return view('livewire.user.product-index', [
            'products' => $products,
            'categories' => $categories,
            'communities' => $communities, // Pasar comunidades a la vista
        ]);
    }
}


