<?php
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PresentacionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('panel.index');
});

Route::view('/panel', 'panel.index')->name('panel');

Route::resources([
    'categorias' => CategoriaController::class,
    'marcas' => MarcaController::class,
    'presentaciones' => PresentacionController::class,
    'productos' => ProductoController::class,
    'clientes' => ClientesController::class,
]);

Route::post('/productos/guardar-temporal', [ProductoController::class, 'guardarTemporal'])->name('productos.guardarTemporal');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/401', function () {
    return view('pages.401');
});

Route::get('/404', function () {
    return view('pages.404');
});

Route::get('/500', function () {
    return view('pages.500');
});