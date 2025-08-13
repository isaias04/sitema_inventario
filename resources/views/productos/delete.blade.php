@extends('layouts.app')

@section('content')
<h2>Eliminar Producto</h2>

<div class="alert alert-danger">
    <p>¿Estás seguro que deseas eliminar el siguiente producto?</p>
</div>

<ul class="list-group mb-3">
    <li class="list-group-item"><strong>Nombre:</strong> {{ $producto->nombre }}</li>
    <li class="list-group-item"><strong>Categoría:</strong> {{ $producto->categoria }}</li>
    <li class="list-group-item"><strong>Stock:</strong> {{ $producto->stock }}</li>
    <li class="list-group-item"><strong>Precio de Compra:</strong> ${{ $producto->precio_compra }}</li>
    <li class="list-group-item"><strong>Precio de Venta:</strong> ${{ $producto->precio_venta }}</li>
    <li class="list-group-item"><strong>Fecha de Vencimiento:</strong>
        @if($producto->fecha_vencimiento && $producto->fecha_vencimiento < now())
            <span class="text-danger">Vencido</span>
        @else
            {{ $producto->fecha_vencimiento }}
        @endif
    </li>
</ul>

<form action="{{ route('productos.destroy', $producto) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Eliminar</button>
    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection