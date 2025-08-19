@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Agregar Producto</a>

    <form action="{{ route('productos.index') }}" method="GET" class="mb-3 d-flex" role="search">
        <input type="text" name="buscar" class="form-control me-2" placeholder="Buscar producto..." value="{{ request('buscar') }}">
        <button type="submit" class="btn btn-outline-warning">Buscar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-outline-success ms-2">Limpiar</a>
    </form>

    <h2>Lista de Productos</h2>

    <table class="table table-bordered align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Vencimiento</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                <td>{{ $producto->stock }}</td>
                <td>${{ number_format($producto->precio_compra, 2) }}</td>
                <td>${{ number_format($producto->precio_venta, 2) }}</td>
                <td>
                    @if($producto->fecha_vencimiento && $producto->fecha_vencimiento < now())
                        <span class="text-danger">Vencido</span>
                    @else
                        {{ $producto->fecha_vencimiento ?? '—' }}
                    @endif
                </td>
                <td>
                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen de {{ $producto->nombre }}" width="80" height="80" style="object-fit: cover; border-radius: 5px;">
                    @else
                        <span class="text-muted">Sin imagen</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('productos.show', $producto) }}" class="btn btn-sm btn-info mb-1">Ver</a>
                    <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-warning mb-1">Editar</a>
                    <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-muted">No se encontraron productos.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $productos->links() }}
    </div>
</div>
@endsection