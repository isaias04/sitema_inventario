@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Editar Producto</h2>

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

    <div class="row justify-content-center">
        {{-- Columna 1 --}}
        <div class="col-md-4">
            <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control"
                           value="{{ old('nombre', $producto->nombre) }}" required>
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría</label>
                    <input type="text" name="categoria" class="form-control"
                           value="{{ old('categoria', $producto->categoria) }}" required>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control"
                           value="{{ old('stock', $producto->stock) }}" required min="0">
                </div>

                <div class="mb-3">
                    <label for="precio_compra" class="form-label">Precio de Compra</label>
                    <input type="number" step="0.01" name="precio_compra" id="precio_compra" class="form-control"
                           value="{{ old('precio_compra', $producto->precio_compra) }}" required min="0">
                </div>
            </form>
        </div>

        {{-- Columna 2 --}}
        <div class="col-md-4">
            <form>
                <div class="mb-2">
                    <div id="precioVentaPreview" class="alert alert-info p-2" style="display: none;"></div>
                </div>

                <div class="mb-3">
                    <label for="precio_venta" class="form-label">Precio de Venta (con IVA y ganancia)</label>
                    <input type="text" name="precio_venta" id="precio_venta" class="form-control"
                           value="{{ old('precio_venta', $producto->precio_venta) }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                    <input type="date" name="fecha_vencimiento" class="form-control"
                           value="{{ old('fecha_vencimiento', $producto->fecha_vencimiento) }}">
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Actualizar imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>

        {{-- Columna 3: Imagen --}}
        <div class="col-md-4 text-center">
            @if($producto->imagen)
                <p class="fw-semibold">Imagen actual:</p>
                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen actual"
                     class="img-fluid rounded shadow" style="max-height: 300px; object-fit: cover;">
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" name="eliminar_imagen" id="eliminar_imagen" form="formulario-edicion">
                    <label class="form-check-label" for="eliminar_imagen">
                        Eliminar imagen actual
                    </label>
                </div>
            @else
                <div class="text-muted mt-5">Sin imagen disponible</div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const precioCompraInput = document.getElementById('precio_compra');
        const precioVentaInput = document.getElementById('precio_venta');
        const precioVentaPreview = document.getElementById('precioVentaPreview');

        function calcularPrecioVenta() {
            const precioCompra = parseFloat(precioCompraInput.value);
            if (!isNaN(precioCompra)) {
                const precioConIVA = precioCompra * 1.13;
                const precioVenta = (precioConIVA * 1.40).toFixed(2);
                precioVentaInput.value = precioVenta;
                precioVentaPreview.textContent = `💡 Precio de venta calculado: $${precioVenta}`;
                precioVentaPreview.style.display = 'block';
            } else {
                precioVentaInput.value = '';
                precioVentaPreview.textContent = '';
                precioVentaPreview.style.display = 'none';
            }
        }

        precioCompraInput.addEventListener('input', calcularPrecioVenta);
        calcularPrecioVenta();
    });
</script>
@endsection