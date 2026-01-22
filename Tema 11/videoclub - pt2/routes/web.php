<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;

Route::get('/', [HomeController::class, 'getHome']);

Route::middleware('auth')->group(function () {
    Route::get('/catalog', [CatalogController::class, 'getIndex']);
    Route::get('/catalog/show/{id}', [CatalogController::class, 'getShow']);
    Route::get('/catalog/create', [CatalogController::class, 'getCreate']);
    Route::get('/catalog/edit/{id}', [CatalogController::class, 'getEdit']);
    
    Route::post('/catalog/create', [CatalogController::class, 'postCreate']);
    Route::put('/catalog/edit/{id}', [CatalogController::class, 'putEdit']);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
