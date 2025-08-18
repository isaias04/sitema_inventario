@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalle de Entrada</h2>

    <div class="row justify-content-center">
        {{-- Detalles de la entrada --}}
        <div class="col-md-8">
            <table class="table table-bordered">
                <tr>
                    <th>Producto</th>
                    <td>{{ $entrada->producto->nombre }}</td>
                </tr>
                <tr>
                    <th>Cantidad</th>
                    <td>{{ $entrada->cantidad }}</td>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <td>{{ $entrada->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>

            <a href="{{ route('entradas.index') }}" class="btn btn-secondary">Volver</a>
        </div>

        {{-- Imagen del producto --}}
        <div class="col-md-4 text-center">
            @if($entrada->producto->imagen)
                <p class="fw-semibold">Imagen del producto:</p>
                <img src="{{ asset('storage/' . $entrada->producto->imagen) }}" alt="Imagen de {{ $entrada->producto->nombre }}"
                     class="img-fluid rounded shadow" style="max-height: 300px; object-fit: cover;">
            @else
                <div class="text-muted mt-5">Sin imagen disponible</div>
            @endif
        </div>
    </div>
</div>
@endsection