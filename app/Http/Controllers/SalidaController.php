<?php

namespace App\Http\Controllers;

use App\Models\Salida;
use App\Models\Producto;
use App\Models\Entrada; 
use Illuminate\Http\Request;

class SalidaController extends Controller
{
    public function index()
    {
        $salidas = Salida::with('producto')->latest()->get();
        return view('salidas.index', compact('salidas'));
    }

    public function create()
    {
            $productos = Producto::all(['id', 'nombre', 'precio_compra']);
            return view('salidas.create', compact('productos'));

    }

    public function store(Request $request)
{
    $request->validate([
        'producto_id' => 'required|exists:productos,id',
        'cantidad' => 'required|integer|min:1',
        'fecha' => 'required|date',
    ]);

    // Obtener el producto
    $producto = Producto::findOrFail($request->producto_id);

    // Calcular el precio unitario: IVA 13% + ganancia 40%
    $precio_con_iva = $producto->precio_compra * 1.13;
    $precio_unitario = round($precio_con_iva * 1.40, 2); // Redondeado a 2 decimales

    // Registrar la salida
    Salida::create([
        'producto_id' => $producto->id,
        'cantidad' => $request->cantidad,
        'precio_unitario' => $precio_unitario,
        'fecha' => $request->fecha,
    ]);

    // Reducir el stock
    $producto->reducirStock($request->cantidad);

    return redirect()->route('salidas.index')->with('success', 'Salida registrada correctamente.');
}

    public function show(Salida $salida)
    {
        return view('salidas.show', compact('salida'));
    }

    public function destroy(Salida $salida)
    {
        // Revertir el stock antes de eliminar
        $salida->producto->aumentarStock($salida->cantidad);
        $salida->delete();

        return redirect()->route('salidas.index')->with('success', 'Salida eliminada y stock revertido.');
    }
}