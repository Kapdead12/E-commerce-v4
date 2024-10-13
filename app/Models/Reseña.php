<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reseña extends Model
{
    use HasFactory;
    protected $table = 'resenias';
    protected $fillable = [
        'producto_id',  // Agregado aquí
        'user_id',
        'calificacion',
        'comentario',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
