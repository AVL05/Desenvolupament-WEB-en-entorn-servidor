<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\TareaController;

// Agrupamos las rutas que requieren autenticación
Route::middleware('auth')->group(function () {
    // Rutas para la gestión del perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para la gestión de Tareas (CRUD completo)
    Route::resource('tareas', TareaController::class);
    
    // Ruta adicional para marcar una tarea como completada
    Route::put('tareas/{tarea}/complete', [TareaController::class, 'complete'])->name('tareas.complete');
});

require __DIR__.'/auth.php';
