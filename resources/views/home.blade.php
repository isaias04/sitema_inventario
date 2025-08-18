@extends('layouts.app')

<h1>Bienvenido, {{ Auth::user()->name }}</h1>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Cerrar sesión</button>
</form>

@endsection
