<?php

namespace App\Http\Requests\Mascotas;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMascotaRequest extends FormRequest
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
            
                'nombre' => 'required|string|max:255',
                'especie' => 'required|string|max:255',
                'raza' => 'nullable|string|max:255',
                'peso' => 'required|numeric|min:0',
                'fecha_nacimiento' => 'required|date',
                'propietario_id' => 'required|exists:propietarios,id',

        ];
    }
}
