@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Entradas de Productos</h2>

    <a href="{{ route('entradas.create') }}" class="btn btn-primary mb-3">Registrar Entrada</a>

    <form action="{{ route('entradas.index') }}" method="GET" class="mb-3 d-flex" role="search">
        <input type="text" name="buscar" class="form-control me-2" placeholder="Buscar por producto o fecha..." value="{{ request('buscar') }}">
        <button type="submit" class="btn btn-outline-warning">Buscar</button>
        <a href="{{ route('entradas.index') }}" class="btn btn-outline-success ms-2">Limpiar</a>
    </form>

    <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-light">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario ($)</th>
                <th>Precio Total ($)</th>
                <th>Fecha de Entrada</th>
                <th>Imagen</th>
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
                    @if($entrada->producto->imagen)
                        <img src="{{ asset('storage/' . $entrada->producto->imagen) }}" alt="Imagen de {{ $entrada->producto->nombre }}" width="60" height="60" style="object-fit: cover; border-radius: 5px;">
                    @else
                        <span class="text-muted">Sin imagen</span>
                    @endif
                </td>
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
                <td colspan="7" class="text-center text-muted">No hay entradas registradas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection