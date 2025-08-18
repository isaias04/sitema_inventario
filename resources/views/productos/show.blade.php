@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles del Producto</h2>

    <div class="row">
        {{-- Imagen del producto --}}
        <div class="col-md-4 text-center mb-3">
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen de {{ $producto->nombre }}" class="img-fluid rounded shadow" style="max-height: 300px; object-fit: cover;">
            @else
                <div class="text-muted">Sin imagen disponible</div>
            @endif
        </div>

        {{-- Detalles del producto --}}
        <div class="col-md-8">
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
                    <td>${{ number_format($producto->precio_compra, 2) }}</td>
                </tr>
                <tr>
                    <th>Precio de Venta</th>
                    <td>${{ number_format($producto->precio_venta, 2) }}</td>
                </tr>
                <tr>
                    <th>Fecha de Vencimiento</th>
                    <td>
                        @if($producto->fecha_vencimiento && $producto->fecha_vencimiento < now())
                            <span class="text-danger">Vencido</span>
                        @else
                            {{ $producto->fecha_vencimiento ?? '—' }}
                        @endif
                    </td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
                <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('productos.delete', $producto) }}" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>
@endsection