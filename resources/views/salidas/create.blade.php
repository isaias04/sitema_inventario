@extends('layouts.app')

@section('content')
<h2>Registrar Salida</h2>

<form action="{{ route('salidas.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="producto_id" class="form-label">Producto</label>
        <select name="producto_id" id="producto_id" class="form-control" required>
            <option value="">-- Selecciona un producto --</option>
            @foreach($productos as $producto)
                <option value="{{ $producto->id }}"
                        data-precio="{{ $producto->precio_compra }}">
                    {{ $producto->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" class="form-control" required min="1">
    </div>

    <div class="mb-3">
        <label for="precio_unitario" class="form-label">Precio Unitario (IVA + Ganancia)</label>
        <input type="text" name="precio_unitario" id="precio_unitario" class="form-control" readonly>
    </div>

    <div class="mb-2">
        <div id="totalPreview" class="alert alert-info p-2" style="display: none;"></div>
    </div>

    <div class="mb-3">
        <label for="total" class="form-label">Total (Precio × Cantidad)</label>
        <input type="text" name="total" id="total" class="form-control" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha de Salida</label>
        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('salidas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection

@section('scripts')
<script>
    const productoSelect = document.getElementById('producto_id');
    const cantidadInput = document.getElementById('cantidad');
    const precioUnitarioInput = document.getElementById('precio_unitario');
    const totalInput = document.getElementById('total');
    const totalPreview = document.getElementById('totalPreview');

    function calcularPrecioUnitario(precioCompra) {
        const conIVA = precioCompra * 1.13;
        const conGanancia = conIVA * 1.40;
        return conGanancia.toFixed(2);
    }

    function calcularTotal() {
        const cantidad = parseInt(cantidadInput.value);
        const precioUnitario = parseFloat(precioUnitarioInput.value);

        if (!isNaN(cantidad) && !isNaN(precioUnitario)) {
            const total = (cantidad * precioUnitario).toFixed(2);
            totalInput.value = total;
            totalPreview.textContent = `💰 Total estimado: $${total}`;
            totalPreview.style.display = 'block';
        } else {
            totalInput.value = '';
            totalPreview.textContent = '';
            totalPreview.style.display = 'none';
        }
    }

    productoSelect.addEventListener('change', function () {
        const selected = productoSelect.options[productoSelect.selectedIndex];
        const precioCompra = parseFloat(selected.getAttribute('data-precio'));

        if (!isNaN(precioCompra)) {
            const precioCalculado = calcularPrecioUnitario(precioCompra);
            precioUnitarioInput.value = precioCalculado;
            calcularTotal();
        }
    });

    cantidadInput.addEventListener('input', calcularTotal);
</script>
@endsection