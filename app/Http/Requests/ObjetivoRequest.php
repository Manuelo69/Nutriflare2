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
        return false;
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
            'grasa_objetivo' => 'required|numeric',
            'min_cardio_objetivo' => 'required|numeric',
            'horas_sueño_objetivo' => 'required|numeric|max:23|min:0',
            'minutos_sueño_objetivo' => 'required|numeric|min:0|max:59',
            'IMC_objetivo' => 'required|numeric',
        ];
    }
}
