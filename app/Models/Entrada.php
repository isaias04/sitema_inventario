<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Proveedor;



class Entrada extends Model
{
    //
        protected $fillable = [
        'producto_id',
        'cantidad',
        'precio_unitario',
        'fecha',
    ];

    // Relación: una entrada pertenece a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function proveedor()
{
    return $this->belongsTo(Proveedor::class);
}


}
