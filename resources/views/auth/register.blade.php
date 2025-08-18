@extends('layouts.register')

@section('title', 'Registro')

@section('content')
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5">

                <h1 class="text-center fw-bold mb-5">Crear Cuenta</h1>

                <form method="POST" action="{{ route('register') }}">
                  @csrf

                  {{-- Nombre de usuario --}}
                  <div class="mb-4">
                    <label for="name" class="form-label">Nombre de usuario</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                    </div>
                    @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                  {{-- Correo electrónico --}}
                  <div class="mb-4">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                      <div class="text-danger small">{{ $message }}</div>
                    @enderror
                  </div>

                  {{-- Contraseña --}}
                  <div class="mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                      <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    </div>
                    @error('password')
                      <div class="text-danger small">{{ $message }}</div>
                    @enderror
                  </div>

                  {{-- Confirmar contraseña --}}
                  <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                      <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>
                  </div>

                  {{-- Botón --}}
                  <div class="d-flex justify-content-center mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">Registrarse</button>
                  </div>

                  {{-- Enlace a login --}}
                  <p class="text-center">
                    ¿Ya tienes una cuenta?
                    <a href="{{ route('login') }}">Inicia sesión aquí</a>
                  </p>
                </form>

              </div>

              {{-- Imagen decorativa --}}
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center">
                <img src="https://media.istockphoto.com/id/1292558923/es/vector/icono-de-la-aplicaci%C3%B3n-formulario-de-encuesta-icono-de-examen-prueba-en-l%C3%ADnea-prueba.jpg?s=612x612&w=0&k=20&c=607Qk0SSyFkEXp19x_ZT7OlyZwe9iOACM4RSKayxeg4="
                  class="img-fluid" alt="Imagen de registro">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection