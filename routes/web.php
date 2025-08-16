<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;

// 🛡️ Rutas de autenticación (login, logout, etc.)
Auth::routes();

// 🏠 Ruta raíz: redirige al login si no está autenticado
Route::get('/', function () {
    return Auth::check()
    ? redirect()->route('productos.index')
    : redirect()->route('login');
});


// 🔐 Rutas protegidas: solo accesibles si el usuario ha iniciado sesión
Route::middleware('auth')->group(function () {

    // 📦 Productos
    Route::resource('productos', ProductoController::class);
    Route::get('productos/{producto}/delete', [ProductoController::class, 'delete'])->name('productos.delete');

    // 📥 Entradas
    Route::resource('entradas', EntradaController::class);

    // 📤 Salidas
    Route::resource('salidas', SalidaController::class);
});