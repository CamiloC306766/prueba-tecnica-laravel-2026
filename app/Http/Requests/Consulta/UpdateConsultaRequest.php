<?php

namespace App\Http\Requests\Consulta;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateConsultaRequest extends FormRequest
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
            
            'mascota_id' => 'sometimes|required|exists:mascotas,id',
            'veterinario_id' => 'sometimes|required|exists:veterinarios,id',
            'motivo' => 'sometimes|required|string|max:255',
            'diagnostico' => 'sometimes|nullable|string',
            'estado' => 'sometimes|required|in:pendiente,en_progreso,completada,cancelada',
            'fecha_consulta' => 'sometimes|required|date',
        ];
    }
}
