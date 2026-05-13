<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fecha' => $this->fecha_consulta,
            'motivo' => $this->motivo,
            'diagnostico' => $this->diagnostico,
            'estado' => $this->estado,
            'mascota' => [
                'id' => $this->mascota?->id,
                'nombre' => $this->mascota?->nombre,
                'especie' => $this->mascota?->especie,
                'propietario' => optional($this->mascota?->propietario)->nombre
                    ? trim($this->mascota->propietario->nombre . ' ' . $this->mascota->propietario->apellido)
                    : null,
            ],
            'veterinario' => [
                'id' => $this->veterinario?->id,
                'nombre' => $this->veterinario?->apellido
                    ? trim($this->veterinario->nombre . ' ' . $this->veterinario->apellido)
                    : $this->veterinario?->nombre,
            ],
            'tratamientos' => $this->tratamientos->map(function ($tratamiento) {
                return [
                    'id' => $tratamiento->id,
                    'descripcion' => $tratamiento->descripcion,
                    'dosis' => $tratamiento->dosis,
                    'duracion' => $tratamiento->duracion,
                ];
            })->all(),
        ];
    }
}

