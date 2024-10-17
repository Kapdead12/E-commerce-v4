<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'stock', 'user_id', 'category_id', 'comunidad_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class); 
    }

    public function carritos()
    {
        return $this->belongsToMany(Carrito::class, 'carrito_productos')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }

    public function reseñas()
    {
        return $this->hasMany(Reseña::class);
    }

    public function promociones()
    {
        return $this->hasMany(Promocion::class,'product_id');
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_productos')
                    ->withPivot('cantidad') // Si necesitas la cantidad
                    ->withTimestamps();
    }


}
