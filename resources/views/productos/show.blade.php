@extends('layouts.app')

@section('content')
<h2>Detalles del Producto</h2>

<table class="table table-bordered">
    <tr>
        <th>Nombre</th>
        <td>{{ $producto->nombre }}</td>
    </tr>
    <tr>
        <th>Categoría</th>
        <td>{{ $producto->categoria }}</td>
    </tr>
    <tr>
        <th>Stock</th>
        <td>{{ $producto->stock }}</td>
    </tr>
    <tr>
        <th>Precio de Compra</th>
        <td>${{ $producto->precio_compra }}</td>
    <tr>
        <th>Precio de Venta</th>
        <td>${{ $producto->precio_venta }}</td>
    </tr>
    <tr>
        <th>Fecha de Vencimiento</th>
        <td>
            @if($producto->fecha_vencimiento && $producto->fecha_vencimiento < now())
                <span class="text-danger">Vencido</span>
            @else
                {{ $producto->fecha_vencimiento }}
            @endif
        </td>
    </tr>
</table>

<a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
<a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning">Editar</a>
<a href="{{ route('productos.delete', $producto) }}" class="btn btn-danger">Eliminar</a>
@endsection