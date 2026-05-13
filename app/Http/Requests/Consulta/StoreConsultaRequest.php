<?php

namespace App\Http\Requests\Consulta;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreConsultaRequest extends FormRequest
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
            
                'mascota_id' => 'required|exists:mascotas,id',
                'veterinario_id' => 'required|exists:veterinarios,id',
                'motivo' => 'required|string|max:255',
                'diagnostico' => 'nullable|string',
                'estado' => 'sometimes|in:pendiente,en_progreso,completada,cancelada',
                'fecha_consulta' => 'required|date',
        ];
    }
}
