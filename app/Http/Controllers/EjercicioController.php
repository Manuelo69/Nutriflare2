<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EjercicioController extends Controller
{

    public function show(string $id)
    {
        $ejercicio = Ejercicio::findOrFail($id);
        return response()->json($ejercicio);
    }
    public function create()
    {
        return view("ejercicio.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_ejercicio' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'explicacion' => 'required|string',
            'musculo' => 'required|in:pierna,triceps,biceps,pecho,espalda,abdominales,hombro',
            'correoContacto' => 'required|email'
        ]);

        // Almacenar el archivo en el sistema de archivos y obtener el nombre del archivo
        $request->file('imagen')->store('ejercicios', 'nutriflare');
        $imageName = $request->file('imagen')->getClientOriginalName();

        $ejercicio = new Ejercicio();
        $ejercicio->nombre_ejercicio = $request->nombre_ejercicio;
        $ejercicio->slug = Str::slug($request->nombre_ejercicio);
        $ejercicio->imagen = $imageName; // Almacenar solo el nombre del archivo
        $ejercicio->explicacion = $request->explicacion;
        $ejercicio->musculo = $request->musculo;
        $ejercicio->aprobado = false;
        $ejercicio->correoContacto = $request->correoContacto;
        $ejercicio->save();

        return redirect()->route('dashboard')->with('success', 'Ejercicio subido exitosamente');
    }
}
