@extends('layouts.app')

@section('content')
<h2>Salidas de Productos</h2>
<a href="{{ route('salidas.create') }}" class="btn btn-primary mb-3">Registrar Salida</a>

<form action="{{ route('salidas.index') }}" method="GET" class="mb-3 d-flex" role="search">
    <input type="text" name="buscar" class="form-control me-2" placeholder="Buscar por producto o fecha..." value="{{ request('buscar') }}">
    <button type="submit" class="btn btn-outline-warning">Buscar</button>
    <a href="{{ route('salidas.index') }}" class="btn btn-outline-success ms-2">Limpiar</a>
</form>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <td>Total</td>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($salidas as $salida)
        <tr>
            <td class="producto">{{ $salida->producto->nombre }}</td>
            <td class="cantidad">{{ $salida->cantidad }}</td>
            <td>${{ number_format($salida->precio_unitario, 2) }}</td>
            <td>${{ number_format($salida->precio_unitario * $salida->cantidad, 2) }}</td>
            <td>{{ $salida->created_at->format('d/m/Y') }}</td>
            <td class="acciones text-center">
                <a href="{{ route('salidas.show', $salida) }}" class="btn btn-sm btn-info">Ver</a>
                <form action="{{ route('salidas.destroy', $salida) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar salida?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection