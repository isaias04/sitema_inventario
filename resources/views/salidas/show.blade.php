@extends('layouts.app')

@section('content')
<h2>Detalle de Salida</h2>

<table class="table table-bordered">
    <tr>
        <th>Producto</th>
        <td>{{ $salida->producto->nombre }}</td>
    </tr>
    <tr>
        <th>Cantidad</th>
        <td>{{ $salida->cantidad }}</td>
    </tr>
    <tr>
        <th>Fecha</th>
        <td>{{ $salida->created_at->format('d/m/Y H:i') }}</td>
    </tr>
</table>

<a href="{{ route('salidas.index') }}" class="btn btn-secondary">Volver</a>
@endsection