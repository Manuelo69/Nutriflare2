<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObjetivoRequest;
use App\Models\Objetivo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjetivoController extends Controller
{
    public function store(ObjetivoRequest $request)
    {
        // Obtén el ID del usuario autenticado
        $userId = Auth::id();
        // Busca el progreso del usuario por su ID
        $objetivo = Objetivo::where('user_id', $userId)->first();
        // Si no se encuentra el progreso, crea uno nuevo; de lo contrario, actualiza el progreso existente
        if (!$objetivo) {
            $objetivo = new Objetivo();
            $objetivo->user_id = $userId;
        }
        $objetivo->fill([
            'altura' => $request->altura,
            'peso' => $request->peso_objetivo,
            'grasa_corporal' => $request->grasa_objetivo,
            'minutos_cardio' => $request->min_cardio_objetivo,
            'horas_sueño' => $request->horas_sueño_objetivo,
            'minutos_sueño' => $request->min_sueño_objetivo,
            'imc' => $request->IMC_objetivo,
        ]);
        // Guarda el progreso en la base de datos
        $objetivo->save();
        return redirect()->back()->with('success', 'Objetivo actualizado exitosamente!');
    }

}