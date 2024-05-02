<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\ProgresoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'inicio']);

Route::get('/progreso/{user}', [ProgresoController::class, 'index'])->name('progresos.index');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
