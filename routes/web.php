<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\ObjetivoController;
use App\Http\Controllers\ProgresoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'inicio']);

Route::get('/progreso/{user}', [ProgresoController::class, 'index'])->name('progresos.index');

Route::get('/objetivo/{user}/crear', [ObjetivoController::class, 'create'])->name('objetivo.create');

Route::get('/progreso/{user}/crear', [ProgresoController::class, 'create'])->name('progresos.create');

Route::post('/progreso/{user}/crear', [ProgresoController::class, 'store'])->name('progreso.store');

Route::post('/objetivo/{user}/crear', [ObjetivoController::class, 'store'])->name('objetivo.store');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});