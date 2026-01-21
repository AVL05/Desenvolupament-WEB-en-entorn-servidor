<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/catalog', [CatalogController::class, 'getIndex'])->name('catalog.index');
Route::get('/catalog/show/{id}', [CatalogController::class, 'getShow'])->name('catalog.show');
Route::get('/catalog/create', [CatalogController::class, 'getCreate'])->name('catalog.create');
Route::get('/catalog/edit/{id}', [CatalogController::class, 'getEdit'])->name('catalog.edit');
Route::put('/catalog/update/{id}', [CatalogController::class, 'getUpdate'])->name('catalog.update');
Route::post('/catalog/create', [CatalogController::class, 'getNewMovie'])->name('catalog.create');
Route::put('/catalog/rent/{id}', [CatalogController::class, 'getRentMovie'])->name('catalog.rent');
Route::put('/catalog/return/{id}', [CatalogController::class, 'getReturnMovie'])->name('catalog.return');

require __DIR__ . '/auth.php';
