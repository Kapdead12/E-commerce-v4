<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;
    protected $table = 'promociones';
    protected $fillable = ['product_id', 'name', 'description', 'desc_porcentaje', 'start_date', 'end_date'];

    public function product()
    {
        return $this->belongsTo(Producto::class);
    }
}
