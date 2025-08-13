<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Inventario</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    table th {
        background-color: #0d6efd;
        color: white;
        text-align: center;

        
    }
    table td {
        vertical-align: right;
        text-align: right;
    }

    .table td, .table th {
        padding: 0.75rem;
    }
    .producto {
        text-align: left;
    }
    .categoria {
        text-align: left;
    }
    .stock {
        text-align: center;
    }
    form .form-control {
        max-width: 300px;
    }
    Acciones {
        text-align: center;
    }
    .cantidad {
        text-align: center;
    }
  

</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        
        <a class="navbar-brand text-center" href="#">Inventario</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
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

            <!-- Formulario de búsqueda -->
            <form class="d-flex" action="{{ route('productos.index') }}" method="GET">
                <input class="form-control me-2" type="search" name="buscar" placeholder="Buscar producto..." value="{{ request('buscar') }}">
                <button class="btn btn-outline-light" type="submit">Buscar</button>
            </form>
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