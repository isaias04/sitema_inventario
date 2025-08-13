<?php

namespace App\Http\Controllers;

use App\Models\Salida;
use App\Models\Producto;
use Illuminate\Http\Request;

class SalidaController extends Controller
{
    // Mostrar listado de salidas con búsqueda y paginación
    public function index(Request $request)
    {
        $query = Salida::with('producto')->latest();

        if ($request->filled('buscar')) {
            $buscar = $request->input('buscar');

            $query->whereHas('producto', function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%");
            })->orWhere('fecha', 'like', "%{$buscar}%");
        }

        $salidas = $query->paginate(10);

        return view('salidas.index', compact('salidas'));
    }

    // Mostrar formulario para crear nueva salida
    public function create()
    {
        $productos = Producto::all(['id', 'nombre', 'precio_compra']);
        return view('salidas.create', compact('productos'));
    }

    // Guardar nueva salida
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'fecha' => 'required|date',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Calcular precio unitario: IVA 13% + ganancia 40%
        $precio_con_iva = $producto->precio_compra * 1.13;
        $precio_unitario = round($precio_con_iva * 1.40, 2);

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

    // Mostrar detalles de una salida
    public function show(Salida $salida)
    {
        return view('salidas.show', compact('salida'));
    }

    // Eliminar salida y revertir el stock
    public function destroy(Salida $salida)
    {
        $salida->producto->aumentarStock($salida->cantidad);
        $salida->delete();

        return redirect()->route('salidas.index')->with('success', 'Salida eliminada y stock revertido.');
    }
}