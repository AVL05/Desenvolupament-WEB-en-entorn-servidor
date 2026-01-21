<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Rutas protegidas
Route::middleware(['auth.custom'])->group(function () {
    // Tareas
    Route::resource('tareas', TareaController::class);

    // Búsqueda
    Route::get('/buscar', [TareaController::class, 'buscar'])->name('tareas.buscar');

    // Perfil
    Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil');
    Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

    // Página principal
    Route::get('/', [TareaController::class, 'index'])->name('home');
});

require __DIR__ . '/auth.php';
