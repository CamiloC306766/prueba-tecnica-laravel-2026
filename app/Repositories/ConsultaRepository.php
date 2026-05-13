<?php

namespace App\Repositories;
use App\Models\Consulta;
class ConsultaRepository implements ConsultaRepositoryInterface
{
    public function getConsultas($estado )
    {
        $consultas = Consulta::with(['mascota.propietario', 'veterinario', 'tratamientos'])
            ->when($estado, function ($query) use ($estado) {
                $query->where('estado', $estado);
            })
            ->paginate(15);
        return $consultas;
    }

    public function createConsulta(array $data)
    {
        $consulta = Consulta::create($data);
        return $consulta;
    }

    public function getOneConsulta(Consulta $consulta)
    {
        $consulta->findOrFail($consulta->id);
        $consulta->load(['mascota.propietario', 'veterinario', 'tratamientos']);
        return $consulta;
    }

    public function updateConsulta(Consulta $consulta, array $data)
    {
        $consulta->findOrFail($consulta->id);
        $consulta->update($data);
        return $consulta;
    }

    public function deleteConsulta(Consulta $consulta)
    {
        $consulta->findOrFail($consulta->id);
        $consulta->delete();
    }
}