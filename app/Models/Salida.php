<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Salida;

class Salida extends Model
{
    //
        protected $fillable = [
        'producto_id',
        'cantidad',
        'precio_unitario',
        'fecha',
    ];

    // Relación: una salida pertenece a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

}
