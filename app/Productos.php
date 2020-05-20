<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    public function categorias()
    {
        return $this->belongsTo(Categoria::class);
    }

    protected $fillable = [
        'id', 'categoria_id', 'nombre', 'precio', 'sku'
    ];
}
