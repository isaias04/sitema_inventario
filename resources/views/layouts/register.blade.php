<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Registro')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    .center-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .form-card {
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .form-label {
      font-weight: 600;
    }

    .form-control:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .login-link {
      font-size: 0.95rem;
      color: #0d6efd;
      text-decoration: none;
    }

    .login-link:hover {
      text-decoration: underline;
      color: #084298;
    }
  </style>
</head>
<body>
  <main class="center-wrapper">
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>