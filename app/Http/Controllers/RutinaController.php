<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use App\Models\EjerciciosRutina;
use App\Models\Rutina;
use App\Models\User;
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
        // Desactivar cualquier rutina activa en el mismo día
        Rutina::where('dia_semana', $request->diaSemana)
            ->where('user_id', auth()->id())
            ->update(['activa' => false]);

        $rutina = new Rutina();
        $rutina->dia_semana = $request->diaSemana;
        $rutina->user_id = auth()->id();
        $rutina->activa = true;
        $rutina->save();

        foreach ($request->ejercicios as $ejercicio) {
            EjerciciosRutina::create([
                'rutina_id' => $rutina->id,
                'ejercicio_id' => $ejercicio['id'],
                'series' => $ejercicio['series'],
                'repeticiones' => $ejercicio['repeticiones'],
            ]);
        }

        return redirect()->route('rutina.show', ['user' => auth()->user()->name, 'rutina' => $request->diaSemana]);
    }




    /**
     * Display the specified resource.
     */
    public function show($user, $dia_semana)
    {
        $user = User::where('name', $user)->firstOrFail();
        $rutina = Rutina::where('user_id', $user->id)
            ->where('dia_semana', $dia_semana)
            ->where('activa', true)
            ->with('ejerciciosRutina.ejercicio')
            ->first();

        return view('rutina.show', compact('rutina', 'dia_semana', 'user'));
    }

    public function showModal(string $id)
    {
        $ejercicio = Ejercicio::findOrFail($id);
        return response()->json($ejercicio);
    }



    /**
     * Show the form for editing the specified resource.
     */
    // RutinaController.php

    public function edit($id)
    {
        $rutina = Rutina::with('ejerciciosRutina.ejercicio')->findOrFail($id);
        $ejercicios = Ejercicio::where('aprobado', true)->paginate(12);
        return view('rutina.edit', compact('rutina', 'ejercicios'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $rutina = Rutina::findOrFail($id);
        $rutina->dia_semana = $request->diaSemana;
        $rutina->save();

        // Eliminar ejercicios existentes
        EjerciciosRutina::where('rutina_id', $rutina->id)->delete();

        // Añadir nuevos ejercicios
        foreach ($request->ejercicios as $ejercicio) {
            EjerciciosRutina::create([
                'rutina_id' => $rutina->id,
                'ejercicio_id' => $ejercicio['id'],
                'series' => $ejercicio['series'],
                'repeticiones' => $ejercicio['repeticiones'],
            ]);
        }

        return redirect()->route('rutina.show', ['user' => auth()->user()->name, 'rutina' => $request->diaSemana]);
    }



}