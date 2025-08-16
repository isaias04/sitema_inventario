<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mi Aplicación')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
<style>
    /* Fondo oscuro y centrado vertical/horizontal */
    body {
        background-color: #343a40;
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Contenedor principal */
    #login {
        width: 100%;
        max-width: 1000px; /* Más ancho */
    }

    /* Caja del formulario */
    #login-box {
        background: #fff;
        padding: 60px; /* Más espacio interno */
        border-radius: 12px;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.4);
    }

    /* Títulos y etiquetas */
    .text-info {
        color: #17a2b8 !important;
        font-size: 1.1rem;
    }

    h3.text-info {
        font-size: 2rem;
        margin-bottom: 30px;
    }

    /* Inputs más grandes y cómodos */
    .form-control {
        border-radius: 8px;
        padding: 0.85rem 1rem;
        font-size: 1.05rem;
        width: 100%;
    }

    /* Espaciado entre campos */
    .form-group {
        margin-bottom: 1.75rem;
    }

    /* Botón de acceso */
    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        font-weight: bold;
        padding: 0.85rem 1.5rem;
        font-size: 1.05rem;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }

    /* Enlace de registro */
    #register-link a {
        text-decoration: none;
        font-weight: 500;
        font-size: 1rem;
    }
</style>
</head>
<body>
    @yield('content')

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>