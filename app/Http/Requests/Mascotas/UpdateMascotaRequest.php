<?php

namespace App\Http\Requests\Mascotas;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMascotaRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'sometimes|required|string|max:255',
            'especie' => 'sometimes|required|string|max:255',
            'raza' => 'sometimes|nullable|string|max:255',
            'peso' => 'sometimes|required|numeric|min:0',
            'fecha_nacimiento' => 'sometimes|required|date',
            'propietario_id' => 'sometimes|required|exists:propietarios,id',
        ];
    }
}
