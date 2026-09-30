<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'categoria', 'precio', 'stock'];

    public function compraItems()
    {
        return $this->hasMany(CompraItem::class);
    }
}
