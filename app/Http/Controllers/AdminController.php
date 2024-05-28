<?php

namespace App\Http\Controllers;

use App\Mail\EjercicioAprobado;
use App\Mail\EjercicioRechazado;
use App\Models\Ejercicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Mostrar la vista para aprobar ejercicios.
     */
    public function cargarEjercicios(Request $request)
    {
        $query = Ejercicio::where('aprobado', false);

        if ($request->filled('search')) {
            $query->where('nombre_ejercicio', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('musculo')) {
            $query->where('musculo', $request->musculo);
        }

        if ($request->filled('correo')) {
            $query->where('correoContacto', 'like', '%' . $request->correo . '%');
        }

        $ejerciciosPendientes = $query->paginate(12);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.ejercicios.partials.ejercicios-table', compact('ejerciciosPendientes'))->render(),
                'pagination' => (string) $ejerciciosPendientes->links()
            ]);
        }

        return view('admin.ejercicios.aprobar', compact('ejerciciosPendientes'));
    }

    public function aprobarEjercicio($id)
    {
        $ejercicio = Ejercicio::findOrFail($id);
        $ejercicio->aprobado = true;
        $ejercicio->save();

        Mail::to($ejercicio->correoContacto)->send(new EjercicioAprobado($ejercicio));

        return redirect()->route('admin.ejercicios.aprobar')->with('success', 'Ejercicio aprobado correctamente.');
    }

    public function rechazarEjercicio($id)
    {
        $ejercicio = Ejercicio::findOrFail($id);
        Mail::to($ejercicio->correoContacto)->send(new EjercicioRechazado($ejercicio));
        $ejercicio->delete();

        return redirect()->route('admin.ejercicios.aprobar')->with('success', 'Ejercicio rechazado correctamente.');
    }

    /**
     * Mostrar la vista para moderar usuarios.
     */
    public function moderarUsuarios()
    {
        // Lógica para obtener los usuarios a moderar
        $usuarios = User::all();
        return view('admin.usuarios.moderar', compact('usuarios'));
    }
}