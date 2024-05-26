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

        // Crear una nueva instancia de Seguimiento para almacenar el seguimiento actual
        $seguimientoNuevo = new Seguimiento();
        $seguimientoNuevo->altura = $seguimiento->altura;
        $seguimientoNuevo->peso = $seguimiento->peso;
        $seguimientoNuevo->grasa_corporal = $seguimiento->grasa;
        $seguimientoNuevo->minutos_cardio = $seguimiento->min_cardio;
        $seguimientoNuevo->horas_sueño = $seguimiento->horas_sueño;
        $seguimientoNuevo->minutos_sueño = $seguimiento->min_sueño;
        $seguimientoNuevo->imc = $seguimiento->IMC;
        $seguimientoNuevo->tipo = 'seguimiento';

        // Calcular las diferencias entre el último seguimiento base y el objetivo
        $diferenciaAltura = $ultimoSeguimientoObjetivo->altura - $ultimoSeguimientoBase->altura;
        $diferenciaPeso = $ultimoSeguimientoBase->peso - $ultimoSeguimientoObjetivo->peso; // Ajustar para perder peso
        $diferenciaGrasa = $ultimoSeguimientoBase->grasa_corporal - $ultimoSeguimientoObjetivo->grasa_corporal; // Ajustar para perder grasa
        $diferenciaCardio = $ultimoSeguimientoObjetivo->minutos_cardio - $ultimoSeguimientoBase->minutos_cardio; // Ajustar para aumentar el cardio
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
        $diferenciaAlturaSigno = $diferenciaAltura >= 0 ? 1 : -1;
        $diferenciaPesoSigno = $diferenciaPeso >= 0 ? 1 : -1; // Ajuste para pérdida de peso
        $diferenciaGrasaSigno = $diferenciaGrasa >= 0 ? 1 : -1; // Ajuste para pérdida de grasa
        $diferenciaCardioSigno = $diferenciaCardio >= 0 ? 1 : -1; // Ajuste para aumento de cardio
        $diferenciaSuenoSigno = $diferenciaTotalSueno >= 0 ? 1 : -1; // Ajuste para aumento de sueño
        $diferenciaIMCSigno = $diferenciaIMC >= 0 ? 1 : -1;

        // Calcular el progreso de cada campo
        $progresoAltura = $diferenciaAltura != 0 ? ($diferenciaAlturaSigno * ($seguimiento->altura - $ultimoSeguimientoBase->altura) / abs($diferenciaAltura)) * 100 : 0;
        $progresoPeso = $diferenciaPeso != 0 ? ($diferenciaPesoSigno * ($ultimoSeguimientoBase->peso - $seguimiento->peso) / abs($diferenciaPeso)) * 100 : 0;
        $progresoGrasa = $diferenciaGrasa != 0 ? ($diferenciaGrasaSigno * ($ultimoSeguimientoBase->grasa_corporal - $seguimiento->grasa_corporal) / abs($diferenciaGrasa)) * 100 : 0;
        $progresoCardio = $diferenciaCardio != 0 ? ($diferenciaCardioSigno * ($seguimiento->min_cardio - $ultimoSeguimientoBase->minutos_cardio) / abs($diferenciaCardio)) * 100 : 0;
        $progresoSueno = $diferenciaTotalSueno != 0 ? ($diferenciaSuenoSigno * ($totalMinutosSuenoNuevo - $totalMinutosSuenoBase) / abs($diferenciaTotalSueno)) * 100 : 0;
        $progresoIMC = $diferenciaIMC != 0 ? ($diferenciaIMCSigno * ($seguimiento->IMC - $ultimoSeguimientoBase->imc) / abs($diferenciaIMC)) * 100 : 0;

        // Calcular el progreso total
        $progresoTotal = ($progresoAltura + $progresoPeso + $progresoGrasa + $progresoCardio + $progresoSueno + $progresoIMC) / 6;

        // Guardar los datos del seguimiento actual en la base de datos
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