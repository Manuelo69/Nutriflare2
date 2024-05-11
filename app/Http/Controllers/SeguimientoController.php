<?php

namespace App\Http\Controllers;

use App\Models\Seguimiento;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $ultimoSeguimientoBase = Seguimiento::where('tipo', 'base')
            ->orderByDesc('created_at')
            ->first();
        $ultimoSeguimientoObjetivo = Seguimiento::where('tipo', 'objetivo')
            ->orderByDesc('created_at')
            ->first();
        return view('progresos.index', ['user' => $user, 'ultimoSeguimientoObjetivo' => $ultimoSeguimientoObjetivo, 'ultimoSeguimientoBase' => $ultimoSeguimientoBase]);
    }
}