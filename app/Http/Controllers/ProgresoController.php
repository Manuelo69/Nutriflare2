<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObjetivoRequest;
use App\Http\Requests\ProgresoRequest;
use App\Models\Objetivo;
use App\Models\Progreso;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProgresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        return view('progresos.index', ['user' => $user]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProgresoRequest $request)
    {
        try {
            // Obtén el ID del usuario autenticado
            $userId = Auth::id();

            // Busca el progreso del usuario por su ID
            $progreso = Progreso::where('user_id', $userId)->first();

            // Si no se encuentra el progreso, crea uno nuevo; de lo contrario, actualiza el progreso existente
            if (!$progreso) {
                $progreso = new Progreso();
                $progreso->user_id = $userId;
            }

            $progreso->fill([
                'altura' => $request->altura,
                'peso' => $request->peso,
                'grasa_corporal' => $request->grasa,
                'minutos_cardio' => $request->min_cardio,
                'horas_sueño' => $request->horas_sueño,
                'minutos_sueño' => $request->min_sueño,
                'imc' => $request->IMC,
            ]);
            // Guarda el progreso en la base de datos
            $progreso->save();
            return redirect()->back()->with('success', '¡Progreso actualizado exitosamente!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', '¡Error al actualizar el progreso!');
        }

    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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