<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObjetivoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'altura_objetivo' => 'required|numeric',
            'peso_objetivo' => 'required|numeric',
            'grasa_corporal_objetivo' => 'required|numeric',
            'minutos_cardio_objetivo' => 'required|numeric',
            'horas_sueño_objetivo' => 'required|numeric|max:23|min:0',
            'minutos_sueño_objetivo' => 'required|numeric|min:0|max:59',
            'IMC_objetivo' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'altura_objetivo.required' => 'El campo altura es obligatorio.',
            'altura_objetivo.numeric' => 'El campo altura debe ser un valor numérico.',
            'peso_objetivo.required' => 'El campo peso es obligatorio.',
            'peso_objetivo.numeric' => 'El campo peso debe ser un valor numérico.',
            'grasa_corporal_objetivo.required' => 'El campo grasa corporal es obligatorio.',
            'grasa_corporal_objetivo.numeric' => 'El campo grasa corporal debe ser un valor numérico.',
            'minutos_cardio_objetivo.required' => 'El campo minutos cardio es obligatorio.',
            'minutos_cardio_objetivo.numeric' => 'El campo minutos cardio debe ser un valor numérico.',
            'horas_sueño_objetivo.required' => 'El campo horas de sueño es obligatorio.',
            'horas_sueño_objetivo.numeric' => 'El campo horas de sueño debe ser un valor numérico.',
            'horas_sueño_objetivo.max' => 'El campo horas de sueño no puede ser mayor a 23.',
            'horas_sueño_objetivo.min' => 'El campo horas de sueño no puede ser menor a 0.',
            'minutos_sueño_objetivo.required' => 'El campo minutos de sueño es obligatorio.',
            'minutos_sueño_objetivo.numeric' => 'El campo minutos de sueño debe ser un valor numérico.',
            'minutos_sueño_objetivo.min' => 'El campo minutos de sueño no puede ser menor a 0.',
            'minutos_sueño_objetivo.max' => 'El campo minutos de sueño no puede ser mayor a 59.',
            'IMC_objetivo.required' => 'El campo IMC es obligatorio.',
            'IMC_objetivo.numeric' => 'El campo IMC debe ser un valor numérico.',

        ];

    }
}