<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Entrada;


class Proveedor extends Model
{
    //
    protected $table = 'proveedores';
    protected $fillable = [
        'nombre_proveedor',
        'empresa',
        'telefono',
        'email',
        'direccion',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function entradas()
    {
    return $this->hasMany(Entrada::class);
    }


}
