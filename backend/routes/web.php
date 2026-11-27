<?php

use Illuminate\Support\Facades\Route;

// El portal dibuja la vista correcta según la dirección:
// inicio (todas las revistas), una revista o un artículo.
Route::get('/', fn () => view('portal'));
Route::get('/revistas/{revista}', fn () => view('portal'));
Route::get('/revistas/{revista}/articulos/{articulo}', fn () => view('portal'));

// Panel de administración (la página exige sesión de administrador en la API).
Route::get('/admin', fn () => view('admin'));
