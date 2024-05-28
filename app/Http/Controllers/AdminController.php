<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Mostrar la vista para aprobar ejercicios.
     */
    public function aprobarEjercicios()
    {
        // Lógica para obtener los ejercicios pendientes de aprobación
        $ejerciciosPendientes = Ejercicio::where('aprobado', false)->get();

        return view('admin.ejercicios.aprobar', compact('ejerciciosPendientes'));
    }

    /**
     * Mostrar la vista para moderar usuarios.
     */
    public function moderarUsuarios()
    {
        if (Auth::user()->hasRole('admin')) {
            // Lógica para obtener los usuarios a moderar
            $usuarios = User::all();
            return view('admin.usuarios.moderar', compact('usuarios'));
        }
    }
}
