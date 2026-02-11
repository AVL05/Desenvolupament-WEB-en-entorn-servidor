<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\PolizaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
    
    Route::get('/polizas', [PolizaController::class, 'index'])->name('polizas.index');
    Route::get('/polizas/create', [PolizaController::class, 'create'])->name('polizas.create');
    Route::post('/polizas', [PolizaController::class, 'store'])->name('polizas.store');
    Route::get('/polizas/{id}/edit', [PolizaController::class, 'edit'])->name('polizas.edit');
    Route::put('/polizas/{id}', [PolizaController::class, 'update'])->name('polizas.update');
    Route::delete('/polizas/{id}', [PolizaController::class, 'destroy'])->name('polizas.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
