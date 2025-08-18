@extends('layouts.login')

@section('title', 'Iniciar sesión')

@section('content')
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="login-form" class="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <h3 class="text-center text-info">Iniciar seción</h3>

                        <div class="form-group">
                            <label for="email" class="text-info">Correo electrónico:</label><br>
                            <input type="email" name="email" id="email" class="form-control" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="password" class="text-info">Contraseña:</label><br>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="remember" class="text-info">
                                <span>Recordarme</span>
                                <span><input id="remember" name="remember" type="checkbox"></span>
                            </label><br>
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Acceder">
                        </div>

                        <div id="register-link" class="text-center mt-3">
                            <a href="{{ route('register') }}" class="text-info">Registrarse</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection