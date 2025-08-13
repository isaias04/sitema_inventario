@extends('layouts.app')

@section('content')
<a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Agregar Producto</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Precio Compra</th>
            <th>Precio Venta</th>
            <th>Vencimiento</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->categoria }}</td>
            <td>{{ $producto->stock }}</td>
            <td>${{ $producto->precio_compra }}</td>
            <td>${{ number_format($producto->precio_venta, 2) }}</td>
            <td>@if($producto->fecha_vencimiento && $producto->fecha_vencimiento < now())
            <span class="text-danger">Vencido</span>
            @else
            {{ $producto->fecha_vencimiento }}
            @endif
        </td>
        <td>
            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-warning">Editar</a>
            <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
            </form>
        </td>
    </tr>
        @endforeach
    </tbody>
</table>

@endsection