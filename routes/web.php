<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\ObjetivoController;
use App\Http\Controllers\ProgresoController;
use App\Http\Controllers\SeguimientoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'inicio']);

Route::get('/seguimiento/{user}', [SeguimientoController::class, 'index'])->name('seguimiento.index');

Route::get('/seguimiento/{user}/crear', [SeguimientoController::class, 'create'])->name('seguimiento.create');

Route::get('/seguimiento/{user}/total', [SeguimientoController::class, 'show'])->name('seguimiento.show');

Route::get('/seguimiento/{user}/ultimoSeguimiento', [SeguimientoController::class, 'show2'])->name('seguimiento.show2');

Route::get('/seguimiento/{user}/editar', [SeguimientoController::class, 'edit'])->name('seguimiento.edit');

Route::post('/seguimiento/{user}/', [SeguimientoController::class, 'store'])->name('seguimiento.store');

Route::post('/seguimiento/{user}/crear', [SeguimientoController::class, 'calcularProgreso'])->name('seguimiento.calculo');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});