<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/incidents');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'getProfile']);
    Route::get('/profile/edit', [ProfileController::class, 'getEdit']);
    Route::put('/profile/edit', [ProfileController::class, 'putEdit']);
});

use App\Http\Controllers\IncidentController;
require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/incidents', [IncidentController::class, 'getIndex']);
    Route::get('/incidents/show/{id}', [IncidentController::class, 'getShow']);

    Route::get('/incidents/create', [IncidentController::class, 'getCreate']);
    Route::post('/incidents/create', [IncidentController::class, 'postCreate'])->middleware(\App\Http\Middleware\WorkHoursOnly::class);

    Route::get('/incidents/edit/{id}', [IncidentController::class, 'getEdit']);
    Route::put('/incidents/edit/{id}', [IncidentController::class, 'putEdit']);

    Route::put('/incidents/resolve/{id}', [IncidentController::class, 'putResolve']);
});
