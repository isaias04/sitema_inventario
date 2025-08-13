@extends('layouts.app')

@section('title', 'Agregar Producto')

@section('content')
<div class="container">
    <h2 class="mb-4">Agregar Producto</h2>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups...</strong> Hay algunos problemas con los datos ingresados:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario de creación --}}
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" name="categoria" class="form-control" value="{{ old('categoria') }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required min="0">
        </div>

        <div class="mb-3">
            <label for="precio_compra" class="form-label">Precio de Compra</label>
            <input type="number" step="0.01" name="precio_compra" id="precio_compra" class="form-control" value="{{ old('precio_compra') }}" required min="0">
        </div>

        <div class="mb-2">
            <small id="precioVentaPreview" class="text-success fw-semibold d-block"></small>
        </div>

        <div class="mb-3">
            <label for="precio_venta" class="form-label">Precio de Venta (con IVA y ganancia)</label>
            <input type="text" name="precio_venta" id="precio_venta" class="form-control" value="{{ old('precio_venta') }}" readonly>
        </div>

        <div class="mb-3">
            <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
            <input type="date" name="fecha_vencimiento" class="form-control" value="{{ old('fecha_vencimiento') }}">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const precioCompraInput = document.getElementById('precio_compra');
        const precioVentaInput = document.getElementById('precio_venta');
        const precioVentaPreview = document.getElementById('precioVentaPreview');
        const formulario = document.querySelector('form');

        function calcularPrecioVenta() {
            const precioCompra = parseFloat(precioCompraInput.value);
            if (!isNaN(precioCompra)) {
                const precioConIVA = precioCompra * 1.13;
                const precioVenta = (precioConIVA * 1.40).toFixed(2);
                precioVentaInput.value = `$${precioVenta}`;
                precioVentaPreview.textContent = `💡 Precio de venta calculado: $${precioVenta}`;
            } else {
                precioVentaInput.value = '';
                precioVentaPreview.textContent = '';
            }
        }

        precioCompraInput.addEventListener('input', calcularPrecioVenta);
        calcularPrecioVenta();

        formulario.addEventListener('submit', function () {
            const valor = precioVentaInput.value.replace('$', '');
            precioVentaInput.value = valor;
        });
    });
</script>
@endsection