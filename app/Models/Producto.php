<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
     protected $fillable = [
        'nombre',
        'categoria',
        'stock',
        'precio_compra',
        'precio_venta',
        'fecha_vencimiento',
        'imagen', 

    ];

  // Relación: un producto tiene muchas entradas
    public function entradas()
    {
        return $this->hasMany(Entrada::class);
    }

    // Relación: un producto tiene muchas salidas
    public function salidas()
    {
        return $this->hasMany(Salida::class);
    }
    public function aumentarStock($cantidad)
    {
    $this->stock += $cantidad;
    $this->save();
}
    public function reducirStock($cantidad)
    {
        $this->stock -= $cantidad;
        $this->save();
    }
    
    // Método para obtener el precio de venta
    public function getPrecioVentaAttribute()
{
    $precio_con_iva = $this->precio_compra * 1.13;
    return round($precio_con_iva * 1.40, 2);
}


}
