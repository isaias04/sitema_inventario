<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;

// Página principal (opcional)
Route::get('/', function () {
    return redirect()->route('productos.index');
});

// 🧾 Rutas para productos
Route::resource('productos', ProductoController::class);

// Ruta adicional para vista de confirmación de eliminación (si usas delete.blade.php)
Route::get('productos/{producto}/delete', [ProductoController::class, 'delete'])->name('productos.delete');

// 📥 Rutas para entradas
Route::resource('entradas', EntradaController::class);

// 📤 Rutas para salidas
Route::resource('salidas', SalidaController::class);