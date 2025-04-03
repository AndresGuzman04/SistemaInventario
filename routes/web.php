<?php
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('panel.index');
});

Route::view('/panel', 'panel.index')->name('panel');

Route::resource('categorias', CategoriaController::class);

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