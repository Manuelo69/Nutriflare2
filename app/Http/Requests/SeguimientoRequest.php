<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeguimientoRequest extends FormRequest
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
            'altura' => 'required|numeric',
            'peso' => 'required|numeric',
            'grasa' => 'required|numeric',
            'min_cardio' => 'required|numeric',
            'horas_sueño' => 'required|numeric|max:23|min:0',
            'min_sueño' => 'required|numeric|min:0|max:59',
            'IMC' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'altura.required' => 'El campo altura es obligatorio.',
            'altura.numeric' => 'El campo altura debe ser numérico.',
            'peso.required' => 'El campo peso es obligatorio.',
            'peso.numeric' => 'El campo peso debe ser numérico.',
            'grasa.required' => 'El campo grasa corporal es obligatorio.',
            'grasa.numeric' => 'El campo grasa corporal debe ser numérico.',
            'min_cardio.required' => 'El campo minutos de cardio es obligatorio.',
            'min_cardio.numeric' => 'El campo minutos de cardio debe ser numérico.',
            'horas_sueño.required' => 'El campo horas de sueño es obligatorio.',
            'horas_sueño.numeric' => 'El campo horas de sueño debe ser numérico.',
            'horas_sueño.max' => 'El campo horas de sueño no puede ser mayor a 23.',
            'horas_sueño.min' => 'El campo horas de sueño no puede ser menor a 0.',
            'min_sueño.required' => 'El campo minutos de sueño es obligatorio.',
            'min_sueño.numeric' => 'El campo minutos de sueño debe ser numérico.',
            'min_sueño.max' => 'El campo minutos de sueño no puede ser mayor a 59.',
            'min_sueño.min' => 'El campo minutos de sueño no puede ser menor a 0.',
            'IMC.required' => 'El campo IMC es obligatorio.',
            'IMC.numeric' => 'El campo IMC debe ser numérico.',
            'tipo.required' => 'El campo tipo es obligatorio.',
            'tipo.in' => 'El campo tipo no es válido, los valores han de ser seguimiento, objetivo o tipo',
        ];

    }
}