@extends('layouts.app')

@section('content')
<h2>Entradas de Productos</h2>
<a href="{{ route('entradas.create') }}" class="btn btn-primary mb-3">Registrar Entrada</a>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario ($)</th>
            <th>Precio_total</th>
            <th>Fecha de Entrada</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($entradas as $entrada)
        <tr>
            <td>{{ $entrada->producto->nombre }}</td>
            <td>{{ $entrada->cantidad }}</td>
            <td>${{ number_format($entrada->precio_unitario, 2) }}</td>
            <td>${{ number_format($entrada->cantidad * $entrada->precio_unitario, 2) }}</td>
            <td>{{ \Carbon\Carbon::parse($entrada->fecha)->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('entradas.show', $entrada) }}" class="btn btn-sm btn-info">Ver</a>
                <form action="{{ route('entradas.destroy', $entrada) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar entrada?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No hay entradas registradas.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection