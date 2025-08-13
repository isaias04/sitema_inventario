@csrf

<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $producto->nombre ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="categoria" class="form-label">Categoría</label>
    <input type="text" name="categoria" id="categoria" class="form-control" value="{{ old('categoria', $producto->categoria ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="stock" class="form-label">Stock</label>
    <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $producto->stock ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="precio_venta" class="form-label">Precio de Venta</label>
    <input type="number" step="0.01" name="precio_venta" id="precio_venta" class="form-control" value="{{ old('precio_venta', $producto->precio_venta ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="precio_compra" class="form-label">Precio de Compra</label>
    <input type="number" step="0.01" name="precio_compra" id="precio_compra" class="form-control"
           value="{{ old('precio_compra', $producto->precio_compra ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
    <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="{{ old('fecha_vencimiento', $producto->fecha_vencimiento ?? '') }}">
</div>