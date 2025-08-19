<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Mostrar listado de productos con búsqueda y paginación
    public function index(Request $request)
    {
        $query = Producto::with('categoria');

        if ($request->filled('buscar')) {
            $buscar = $request->input('buscar');
            $query->where('nombre', 'like', "%{$buscar}%")
                  ->orWhereHas('categoria', function ($q) use ($buscar) {
                      $q->where('nombre', 'like', "%{$buscar}%");
                  });
        }

        $productos = $query->paginate(10);

        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario para crear nuevo producto
    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    // Guardar nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'stock' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'fecha_vencimiento' => 'nullable|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $precio_con_iva = $request->precio_compra * 1.13;
        $precio_venta = round($precio_con_iva * 1.40, 2);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('imagenes_productos', 'public');
        }

        Producto::create([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id,
            'stock' => $request->stock,
            'precio_compra' => $request->precio_compra,
            'precio_venta' => $precio_venta,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'imagen' => $rutaImagen,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar detalles de un producto
    public function show($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    // Mostrar formulario para editar producto
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // Actualizar producto
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'stock' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        $producto = Producto::findOrFail($id);

        $precio_con_iva = $request->precio_compra * 1.13;
        $precio_venta = round($precio_con_iva * 1.40, 2);

        $datos = $request->all();
        $datos['precio_venta'] = $precio_venta;

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