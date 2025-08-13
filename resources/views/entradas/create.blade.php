@extends('layouts.app')

@section('content')
<h2>Registrar Entrada</h2>

<form action="{{ route('entradas.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="producto_id" class="form-label">Producto</label>
        <select name="producto_id" id="producto_id" class="form-control" required>
            <option value="">-- Selecciona un producto --</option>
            @foreach($productos as $producto)
                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" class="form-control" required min="1">
    </div>

    <div class="mb-3">
        <label for="precio_unitario" class="form-label">Precio Unitario</label>
        <input type="number" step="0.01" name="precio_unitario" id="precio_unitario" class="form-control" required min="0">
    </div>

    <div class="mb-2">
        <div id="totalPreview" class="alert alert-info p-2" style="display: none;"></div>
    </div>

    <div class="mb-3">
        <label for="total" class="form-label">Total (Precio × Cantidad)</label>
        <input type="text" name="total" id="total" class="form-control" readonly>
    </div>

    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha de Entrada</label>
        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('entradas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection

@section('scripts')
<script>
    const cantidadInput = document.getElementById('cantidad');
    const precioInput = document.getElementById('precio_unitario');
    const totalInput = document.getElementById('total');
    const totalPreview = document.getElementById('totalPreview');

    function calcularTotal() {
        const cantidad = parseInt(cantidadInput.value);
        const precio = parseFloat(precioInput.value);

        if (!isNaN(cantidad) && !isNaN(precio)) {
            const total = (cantidad * precio).toFixed(2);
            totalInput.value = total;
            totalPreview.textContent = `📦 Total estimado: $${total}`;
            totalPreview.style.display = 'block';
        } else {
            totalInput.value = '';
            totalPreview.textContent = '';
            totalPreview.style.display = 'none';
        }
    }

    cantidadInput.addEventListener('input', calcularTotal);
    precioInput.addEventListener('input', calcularTotal);
</script>
@endsection