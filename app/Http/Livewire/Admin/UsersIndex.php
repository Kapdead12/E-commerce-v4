<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Carbon\Carbon;

class UsersIndex extends Component
{
    use WithPagination;
    

    public $search = '';  // Para almacenar el valor del input de búsqueda

    public function updatingSearch()
    {
        $this->resetPage(); // Resetea la paginación al hacer una nueva búsqueda
    }

    public function render()
    {
        // Realiza la búsqueda por nombre completo (name + surname) o correo electrónico
        $users = User::where(function ($query) {
            // Combina la búsqueda en el nombre y apellido juntos
            $query->whereRaw("CONCAT(name, ' ', surname) LIKE ?", ['%' . $this->search . '%'])
                ->orWhere('email', 'like', '%' . $this->search . '%'); // Búsqueda por email
        })->paginate(5);

        return view('livewire.admin.users-index', ['users' => $users]);
    }


}
