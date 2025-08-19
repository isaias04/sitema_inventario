<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Proveedor;

class Categoria extends Model
{
    //
    protected $fillable = ['nombre', 'descripcion'];

    public function proveedores()
{
    return $this->hasMany(Proveedor::class);
}
public function productos()
{
    return $this->hasMany(Producto::class);
}
}
