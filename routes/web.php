<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EjercicioController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\RutinaController;
use App\Http\Controllers\SeguimientoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'inicio']);

// Rutas de seguimiento
Route::get('/seguimiento/{user}', [SeguimientoController::class, 'index'])->name('seguimiento.index')->middleware('auth');
Route::get('/seguimiento/{user}/crear', [SeguimientoController::class, 'create'])->name('seguimiento.create')->middleware('auth');
Route::get('/seguimiento/{user}/total', [SeguimientoController::class, 'show'])->name('seguimiento.show')->middleware('auth');
Route::get('/seguimiento/{user}/ultimoSeguimiento', [SeguimientoController::class, 'show2'])->name('seguimiento.show2')->middleware('auth');
Route::get('/seguimiento/{user}/editar', [SeguimientoController::class, 'edit'])->name('seguimiento.edit')->middleware('auth');
Route::post('/seguimiento/{user}/', [SeguimientoController::class, 'store'])->name('seguimiento.store')->middleware('auth');
Route::post('/seguimiento/{user}/crear', [SeguimientoController::class, 'calcularProgreso'])->name('seguimiento.calculo')->middleware('auth');
Route::get('/estadisticas', [SeguimientoController::class, 'mostrarEstadisticas'])->name('seguimiento.estadisticas')->middleware('auth');


// Rutas de ejercicios
Route::get('/ejercicio/subir', [EjercicioController::class, 'create'])->name('ejercicio.create')->middleware('auth');
Route::post('/ejercicio/guardar', [EjercicioController::class, 'store'])->name('ejercicio.store')->middleware('auth');
Route::get('/ejercicio/{id}', [EjercicioController::class, 'show'])->name('ejercicio.show')->middleware('auth');

// Rutas de rutinas
Route::get('/rutina/{id}/editar', [RutinaController::class, 'edit'])->name('rutina.edit')->middleware('auth');
Route::get('/rutina/{id}/exportar-pdf', [RutinaController::class, 'exportarPDF'])->name('rutina.exportar-pdf')->middleware('auth');
Route::put('/rutina/{id}', [RutinaController::class, 'update'])->name('rutina.update')->middleware('auth');
Route::get('/rutina/crear', [RutinaController::class, 'create'])->name('rutina.create')->middleware('auth');
Route::post('/rutina/guardar', [RutinaController::class, 'store'])->name('rutina.store')->middleware('auth');
Route::get('/rutinas/crear/filtrar', [RutinaController::class, 'filtrar'])->name('rutina.filtrar')->middleware('auth');
Route::get('/ejercicio/{user}/rutina/{rutina}', [RutinaController::class, 'show'])->name('rutina.show')->middleware('auth');



Route::get('/admin/ejercicios/aprobar', [AdminController::class, 'cargarEjercicios'])
    ->name('admin.ejercicios.aprobar')
    ->middleware('auth');

Route::post('/admin/ejercicios/aprobar/{id}', [AdminController::class, 'aprobarEjercicio'])
    ->name('admin.ejercicios.aprobar.post')
    ->middleware('auth');

Route::post('/admin/ejercicios/rechazar/{id}', [AdminController::class, 'rechazarEjercicio'])
    ->name('admin.ejercicios.rechazar.post')
    ->middleware('auth');

Route::get('/admin/usuarios/moderar', [AdminController::class, 'moderarUsuarios'])
    ->name('admin.usuarios.moderar')
    ->middleware('auth');

Route::delete('/admin/usuarios/{id}/eliminar', [AdminController::class, 'eliminarUsuario'])->middleware('auth')->name('admin.usuarios.eliminar');
Route::post('/admin/usuarios/enviarCorreo', [AdminController::class, 'enviarCorreo'])->middleware('auth')->name('admin.usuarios.enviarCorreo');


// Rutas de middleware para autenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});