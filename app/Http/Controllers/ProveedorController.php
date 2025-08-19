<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Categoria;

class ProveedorController extends Controller
{
    // Mostrar todos los proveedores
    public function index()
    {
        $proveedores = Proveedor::with('categoria')->get();
        return view('proveedores.index', compact('proveedores'));
    }

    // Mostrar formulario para crear nuevo proveedor
    public function create()
    {
        $categorias = Categoria::all();
        return view('proveedores.create', compact('categorias'));
    }

    // Guardar nuevo proveedor
    public function store(Request $request)
    {
        $request->validate([
            'nombre_proveedor' => 'required|string|max:255',
            'empresa' => 'required|string|max:150',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Proveedor::create($request->all());

        return redirect()->route('proveedores.index')->with('success', 'Proveedor registrado correctamente.');
    }

    // Mostrar formulario para editar proveedor existente
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $categorias = Categoria::all();
        return view('proveedores.edit', compact('proveedor', 'categorias'));
    }

    // Actualizar proveedor existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_proveedor' => 'required|string|max:255',
            'empresa' => 'required|string|max:150',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->all());

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
    }

    // Eliminar proveedor (opcional)
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();

        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
    }
}