<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Producto;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index()
    {
        $entradas = Entrada::with('producto')->latest()->get();
        return view('entradas.index', compact('entradas'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('entradas.create', compact('productos'));
    }

  // Almacenar una nueva entrada y actualizar el stock del producto
public function store(Request $request)
{
    $request->validate([
        'producto_id' => 'required|exists:productos,id',
        'cantidad' => 'required|integer|min:1',
        'precio_unitario' => 'required|numeric|min:0',
        'fecha' => 'required|date',
    ]);

    // Crear la entrada
    $entrada = Entrada::create([
        'producto_id' => $request->producto_id,
        'cantidad' => $request->cantidad,
        'precio_unitario' => $request->precio_unitario,
        'fecha' => $request->fecha,
    ]);

    // Actualizar el producto
    $producto = Producto::find($request->producto_id);

    // Sumar stock
    $producto->stock += $request->cantidad;

    // Reemplazar precio de compra directamente
    $producto->precio_compra = $request->precio_unitario;

    $producto->save();

    return redirect()->route('entradas.index')->with('success', 'Entrada registrada y precio de compra actualizado.');
}

    public function show(Entrada $entrada)
    {
        return view('entradas.show', compact('entrada'));
    }

    public function destroy(Entrada $entrada)
    {
        // Revertir el stock antes de eliminar
        $entrada->producto->reducirStock($entrada->cantidad);
        $entrada->delete();

        return redirect()->route('entradas.index')->with('success', 'Entrada eliminada y stock revertido.');
    }
}
