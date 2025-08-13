@extends('layouts.app')

@section('content')
<h2>Detalle de Entrada</h2>

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
@endsection