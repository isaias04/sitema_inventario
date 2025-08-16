<h1>Bienvenido, {{ $user->name }}</h1>
<p>Correo: {{ $user->email }}</p>
<p>Registrado el: {{ $user->created_at->format('d/m/Y') }}</p>

<hr>

<h2>📊 Estadísticas</h2>
<ul>
    <li>Total de productos: {{ $totalProductos }}</li>
    <li>Total de entradas: {{ $totalEntradas }}</li>
    <li>Total de salidas: {{ $totalSalidas }}</li>
</ul>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Cerrar sesión</button>
</form>