<?php

namespace App\Http\Controllers;

use App\Mail\CustomMail;
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
    public function moderarUsuarios(Request $request)
    {
        // Lógica para obtener los usuarios a moderar
        $query = User::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('fase_corporal')) {
            $query->where('fase_corporal', $request->fase_corporal);
        }

        $usuarios = $query->paginate(10);

        return view('admin.usuarios.moderar', compact('usuarios'));
    }

    public function eliminarUsuario($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.usuarios.moderar')->with('success', 'Usuario eliminado correctamente');
    }

    public function enviarCorreo(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string',
        ]);

        // Lógica para enviar el correo
        Mail::to($request->email)->send(new CustomMail($request->asunto, $request->mensaje));

        return redirect()->route('admin.usuarios.moderar')->with('success', 'Correo enviado correctamente');
    }

}