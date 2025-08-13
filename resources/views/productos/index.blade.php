@extends('layouts.app')

@section('content')
<a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Agregar Producto</a>
<form action="{{ route('productos.index') }}" method="GET" class="mb-3 d-flex" role="search">
    <input type="text" name="buscar" class="form-control me-2" placeholder="Buscar producto..." value="{{ request('buscar') }}">
    <button type="submit" class="btn btn-outline-warning">Buscar</button>
    <a href="{{ route('salidas.index') }}" class="btn btn-outline-success ms-2">Limpiar</a>

</form>
<h2>Lista de Productos</h2>
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
            <td class="producto">{{ $producto->nombre }}</td>
            <td class="categoria">{{ $producto->categoria }}</td>
            <td class="stock">{{ $producto->stock }}</td>
            <td class="precio">${{ $producto->precio_compra }}</td>
            <td class="precio">${{ number_format($producto->precio_venta, 2) }}</td>
            <td>@if($producto->fecha_vencimiento && $producto->fecha_vencimiento < now())
            <span class="text-danger">Vencido</span>
            @else
            {{ $producto->fecha_vencimiento }}
            @endif
        </td>
        <td class="acciones text-center">
            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-warning">Editar</a>
            <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
            </form>
            <a href="{{ route('productos.show', $producto) }}" class="btn btn-sm btn-info">Ver</a>
        </td>
    </tr>
        @endforeach
    </tbody>
</table>

@endsection