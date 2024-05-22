<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\EjerciciosRutina;
use App\Models\Rutina;
use Illuminate\Http\Request;

class RutinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ejercicios = Ejercicio::where('aprobado', true)->paginate(12);
        return view('rutina.create', ['ejercicios' => $ejercicios]);
    }

    public function filtrar(Request $request)
    {
        $query = Ejercicio::query();

        if ($request->filled('nombre')) {
            $query->where('nombre_ejercicio', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('musculo')) {
            $query->where('musculo', $request->musculo);
        }

        $ejercicios = $query->where('aprobado', true)->paginate(12);

        $paginationHtml = $ejercicios->links()->toHtml();

        return response()->json([
            'html' => view('rutina._lista_ejercicios', compact('ejercicios'))->render(),
            'paginacion' => $paginationHtml,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rutina = new Rutina();
        $rutina->dia_semana = $request->dia_semana;  // Debes ajustar esto según tu formulario
        $rutina->user_id = auth()->id();
        $rutina->save();

        foreach ($request->ejercicios as $ejercicio) {
            EjerciciosRutina::create([
                'rutina_id' => $rutina->id,
                'ejercicio_id' => $ejercicio['id'],
                'series' => $ejercicio['series'],
                'repeticiones' => $ejercicio['repeticiones'],
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ejercicio = Ejercicio::findOrFail($id);
        return response()->json($ejercicio);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
