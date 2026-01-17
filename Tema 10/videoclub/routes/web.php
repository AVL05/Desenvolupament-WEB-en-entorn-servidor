<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;

// Ruta principal - redirige al catálogo
Route::get('/', [HomeController::class, 'getHome'])->name('home');

// Ruta de login (sin controlador por ahora)
Route::get('login', function () {
    return view('auth.login');
})->name('login');

// Ruta de logout (sin controlador por ahora)
Route::get('logout', function () {
    return 'Logout del usuario';
})->name('logout');

// Rutas del catálogo
Route::get('catalog', [CatalogController::class, 'getIndex'])->name('catalog');

Route::get('catalog/show/{id}', [CatalogController::class, 'getShow'])->name('catalog.show');

Route::get('catalog/create', [CatalogController::class, 'getCreate'])->name('catalog.create');

Route::get('catalog/edit/{id}', [CatalogController::class, 'getEdit'])->name('catalog.edit');
