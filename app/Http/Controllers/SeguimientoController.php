<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeguimientoRequest;
use App\Models\Seguimiento;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('seguimiento.index', ['user' => $user, 'ultimoSeguimientoObjetivo' => $ultimoSeguimientoObjetivo, 'ultimoSeguimientoBase' => $ultimoSeguimientoBase]);
    }

    public function create()
    {
        $ultimoSeguimientoBase = Seguimiento::where('tipo', 'base')
            ->orderByDesc('created_at')
            ->first();
        $ultimoSeguimientoObjetivo = Seguimiento::where('tipo', 'objetivo')
            ->orderByDesc('created_at')
            ->first();
        return view('seguimiento.create', ['ultimoSeguimientoObjetivo' => $ultimoSeguimientoObjetivo, 'ultimoSeguimientoBase' => $ultimoSeguimientoBase]);
    }

    public function store(SeguimientoRequest $request)
    {
        try {
            // Crear una nueva instancia de Seguimiento
            $seguimiento = new Seguimiento();
            $seguimiento->altura = $request->altura;
            $seguimiento->peso = $request->peso;
            $seguimiento->grasa_corporal = $request->grasa;
            $seguimiento->minutos_cardio = $request->min_cardio;
            $seguimiento->horas_sueño = $request->horas_sueño;
            $seguimiento->minutos_sueño = $request->min_sueño;
            $seguimiento->imc = $request->IMC;
            $seguimiento->tipo = $request->tipo;
            // Asigna los demás campos del seguimiento aquí

            // Asigna el ID del usuario actual al seguimiento
            $seguimiento->user_id = auth()->user()->id;

            // Guardar el seguimiento en la base de datos
            $seguimiento->save();

            return redirect()->route('seguimiento.index', ['user' => auth()->user()])
                ->with('success', '¡Seguimiento guardado exitosamente!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', '¡Error al guardar el seguimiento!');
        }
    }
    /**
     * Calcula el progreso de cada campo en porcentaje.
     */
    /**
     * Calcula el progreso de cada campo en porcentaje y devuelve un array.
     */
    /**
     * Calcula el progreso de cada campo en porcentaje y devuelve un array.
     */
    /**
     * Calcula el progreso de cada campo en porcentaje y devuelve un array.
     */
    public function calcularProgreso(SeguimientoRequest $seguimiento)
    {
        // Obtener el último seguimiento base
        $ultimoSeguimientoBase = Seguimiento::where('tipo', 'base')
            ->orderByDesc('created_at')
            ->first();

        // Obtener el último seguimiento objetivo
        $ultimoSeguimientoObjetivo = Seguimiento::where('tipo', 'objetivo')
            ->orderByDesc('created_at')
            ->first();

        $seguimientoNuevo = new Seguimiento();
        $seguimientoNuevo->altura = $seguimiento->altura;
        $seguimientoNuevo->peso = $seguimiento->peso;
        $seguimientoNuevo->grasa_corporal = $seguimiento->grasa;
        $seguimientoNuevo->minutos_cardio = $seguimiento->min_cardio;
        $seguimientoNuevo->horas_sueño = $seguimiento->horas_sueño;
        $seguimientoNuevo->minutos_sueño = $seguimiento->min_sueño;
        $seguimientoNuevo->imc = $seguimiento->IMC;
        $seguimientoNuevo->tipo = 'seguimiento';

        // Calcular la diferencia entre el último seguimiento base y el seguimiento objetivo
        $diferenciaAltura = $ultimoSeguimientoObjetivo->altura - $ultimoSeguimientoBase->altura;
        $diferenciaPeso = $ultimoSeguimientoObjetivo->peso - $ultimoSeguimientoBase->peso;
        $diferenciaGrasa = $ultimoSeguimientoObjetivo->grasa_corporal - $ultimoSeguimientoBase->grasa_corporal;
        $diferenciaCardio = $ultimoSeguimientoObjetivo->minutos_cardio - $ultimoSeguimientoBase->minutos_cardio;
        $diferenciaIMC = $ultimoSeguimientoObjetivo->imc - $ultimoSeguimientoBase->imc;

        // Calcular la diferencia entre las horas de sueño
        $diferenciaSuenoHoras = $ultimoSeguimientoObjetivo->horas_sueño - $ultimoSeguimientoBase->horas_sueño;
        $diferenciaSuenoMinutos = $ultimoSeguimientoObjetivo->minutos_sueño - $ultimoSeguimientoBase->minutos_sueño;

        // Convertir los minutos de sueño a horas
        $diferenciaSuenoHoras += floor($diferenciaSuenoMinutos / 60);
        $diferenciaSuenoMinutos %= 60;

        // Calcular el total de minutos de sueño
        $totalMinutosSuenoBase = ($ultimoSeguimientoBase->horas_sueño * 60) + $ultimoSeguimientoBase->minutos_sueño;
        $totalMinutosSuenoNuevo = ($seguimiento->horas_sueño * 60) + $seguimiento->minutos_sueño;

        // Calcular la diferencia total de minutos de sueño
        $diferenciaTotalSueno = ($ultimoSeguimientoObjetivo->horas_sueño * 60) + $ultimoSeguimientoObjetivo->minutos_sueño - $totalMinutosSuenoBase;

        // Determinar si la diferencia es positiva (objetivo de ganancia) o negativa (objetivo de pérdida)
        $diferenciaAlturaSigno = $ultimoSeguimientoObjetivo->altura >= $ultimoSeguimientoBase->altura ? 1 : -1;
        $diferenciaPesoSigno = $ultimoSeguimientoObjetivo->peso >= $ultimoSeguimientoBase->peso ? 1 : -1;
        $diferenciaGrasaSigno = $ultimoSeguimientoObjetivo->grasa_corporal >= $ultimoSeguimientoBase->grasa_corporal ? 1 : -1;
        $diferenciaCardioSigno = $ultimoSeguimientoObjetivo->minutos_cardio >= $ultimoSeguimientoBase->minutos_cardio ? 1 : -1;
        $diferenciaSuenoSigno = $ultimoSeguimientoObjetivo->horas_sueño >= $ultimoSeguimientoBase->horas_sueño ? 1 : -1;
        $diferenciaIMCSigno = $ultimoSeguimientoObjetivo->imc >= $ultimoSeguimientoBase->imc ? 1 : -1;

        // Calcular el porcentaje de progreso para cada campo
        $progresoAltura = ($ultimoSeguimientoObjetivo->altura != 0) ? ($diferenciaAlturaSigno * abs($seguimiento->altura - $ultimoSeguimientoBase->altura) / $diferenciaAltura) * 100 : 0;
        $progresoPeso = ($ultimoSeguimientoObjetivo->peso != 0) ? ($diferenciaPesoSigno * abs($seguimiento->peso - $ultimoSeguimientoBase->peso) / $diferenciaPeso) * 100 : 0;
        $progresoGrasa = ($ultimoSeguimientoObjetivo->grasa_corporal != 0) ? ($diferenciaGrasaSigno * abs($seguimiento->grasa - $ultimoSeguimientoBase->grasa_corporal) / $diferenciaGrasa) * 100 : 0;
        $progresoCardio = ($ultimoSeguimientoObjetivo->minutos_cardio != 0) ? ($diferenciaCardioSigno * abs($seguimiento->min_cardio - $ultimoSeguimientoBase->minutos_cardio) / $diferenciaCardio) * 100 : 0;
        $progresoSueno = ($diferenciaTotalSueno != 0) ? (($totalMinutosSuenoNuevo - $totalMinutosSuenoBase) / $diferenciaTotalSueno) * 100 : 0;
        $progresoIMC = ($ultimoSeguimientoObjetivo->imc != 0) ? ($diferenciaIMCSigno * abs($seguimiento->IMC - $ultimoSeguimientoBase->imc) / $diferenciaIMC) * 100 : 0;

        // Calcular el progreso total
        $progresoTotal = ($progresoAltura + $progresoPeso + $progresoGrasa + $progresoCardio + $progresoSueno + $progresoIMC) / 6;

        // Guardar los últimos datos en la base de datos
        $seguimientoNuevo->porcentaje_progreso = $progresoTotal;
        $seguimientoNuevo->user_id = auth()->user()->id;
        $seguimientoNuevo->save();

        // Redirigir a la vista de seguimiento con los datos de progreso
        return view('seguimiento.show', [
            'progresoAltura' => $progresoAltura,
            'progresoPeso' => $progresoPeso,
            'progresoGrasa' => $progresoGrasa,
            'progresoCardio' => $progresoCardio,
            'progresoSueno' => $progresoSueno,
            'progresoIMC' => $progresoIMC,
            'progresoTotal' => $progresoTotal
        ]);
    }

    function show2()
    {
        $user = auth()->user();
        $ultimoSeguimiento = Seguimiento::where('tipo', 'seguimiento')
            ->orderByDesc('created_at')
            ->first();
        return view('seguimiento.show2', ['user' => $user, 'ultimoSeguimiento' => $ultimoSeguimiento]);

    }


}
