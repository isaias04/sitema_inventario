<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Mostrar listado de productos con búsqueda y paginación
    public function index(Request $request)
    {
        $query = Producto::query();

        if ($request->filled('buscar')) {
            $buscar = $request->input('buscar');
            $query->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('categoria', 'like', "%{$buscar}%");
        }

        $productos = $query->paginate(10);

        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario para crear nuevo producto
    public function create()
    {
        return view('productos.create');
    }

    // Guardar nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        $datos = $request->all();

        // Calcular precio_venta si no viene del formulario
        $precio_con_iva = $datos['precio_compra'] * 1.13;
        $datos['precio_venta'] = round($precio_con_iva * 1.40, 2);

        // También calculamos precio_unitario si lo usas
        $datos['precio_unitario'] = $datos['precio_venta'];

        Producto::create($datos);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar detalles de un producto
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    // Mostrar formulario para editar producto
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    // Actualizar producto
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        $producto = Producto::findOrFail($id);
        $datos = $request->all();

        // Calcular precio_venta si no viene del formulario
        $precio_con_iva = $datos['precio_compra'] * 1.13;
        $datos['precio_venta'] = round($precio_con_iva * 1.40, 2);

        // También actualizamos precio_unitario si lo usas
        $datos['precio_unitario'] = $datos['precio_venta'];

        $producto->update($datos);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }

    // Vista de confirmación de eliminación (opcional)
    public function delete($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.delete', compact('producto'));
    }
}