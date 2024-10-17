<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',           // Agregar esta línea
        'usuario_delivery_id',
        'direccion',
    ];

    public function pedidos() {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }
    
    public function users() {
        return $this->belongsTo(User::class, 'usuario_delivery_id');
    }
}
