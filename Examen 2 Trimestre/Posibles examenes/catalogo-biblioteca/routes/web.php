<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Middleware\CheckYear;
use App\Http\Controllers\ProfileController; // Optional, kept for completeness if needed logic relies on it? No, not in my exam.

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ruta pública
Route::get('/', [HomeController::class, 'getHome']);

// Grupo protegido por autenticación
Route::middleware(['auth'])->group(function () {

    Route::get('/catalog', [CatalogController::class, 'getIndex']);
    Route::get('/catalog/show/{id}', [CatalogController::class, 'getShow']);
    
    // Middleware personalizado asignado a la ruta de creación
    Route::get('/catalog/create', [CatalogController::class, 'getCreate'])
        ->middleware(CheckYear::class);
        
    Route::get('/catalog/edit/{id}', [CatalogController::class, 'getEdit']);

    Route::post('/catalog/create', [CatalogController::class, 'postCreate']);
    Route::put('/catalog/edit/{id}', [CatalogController::class, 'putEdit']);

});

// Rutas de autenticación (Breeze)
require __DIR__.'/auth.php';
