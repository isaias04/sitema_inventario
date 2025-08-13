<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Inventario</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Inventario</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('entradas.*') ? 'active' : '' }}" href="{{ route('entradas.index') }}">Entradas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('salidas.*') ? 'active' : '' }}" href="{{ route('salidas.index') }}">Salidas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}" href="{{ route('productos.index') }}">Productos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <div class="container mt-4">
        <h1 class="mb-4">Sistema de Inventario</h1>
        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>