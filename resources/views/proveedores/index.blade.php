@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Proveedores</h1>

    <a href="{{ route('proveedores.create') }}" class="btn btn-primary mb-3">Nuevo Proveedor</a>

    @if($proveedores->count())
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proveedores as $proveedor)
            <tr>
                <td>{{ $proveedor->nombre_proveedor }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <td>{{ $proveedor->email }}</td>
                <td>{{ $proveedor->direccion }}</td>
                <td>{{ $proveedor->categoria->nombre ?? 'Sin categoría' }}</td>
                <td>
                    <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este proveedor?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info">No hay proveedores registrados.</div>
    @endif
</div>
@endsection