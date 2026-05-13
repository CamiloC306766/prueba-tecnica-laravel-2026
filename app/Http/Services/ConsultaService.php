<?php

namespace App\Http\Services;
use App\Models\Consulta;
use App\Repositories\ConsultaRepositoryInterface;
use App\Contracts\NotificacionInterface;

class ConsultaService
{
    protected $consultaRepository;
    protected $notificador;

    public function __construct(ConsultaRepositoryInterface $consultaRepository, NotificacionInterface $notificador)
    {
        $this->consultaRepository = $consultaRepository;
        $this->notificador = $notificador;
    }

    public function getConsultas($estado)
    {
        $consultas = $this->consultaRepository->getConsultas($estado);
        return $consultas;
    }
    
    public function createConsulta(array $data)
    {
        $consulta = $this->consultaRepository->createConsulta($data);
        $this->notificador->notificar($consulta);
        return $consulta;
        
    }

    public function getOneConsulta(Consulta $consulta)
    {
        $consulta = $this->consultaRepository->getOneConsulta($consulta);
        return $consulta;
        // Lógica para obtener una consulta específica
    }

    public function updateConsulta(Consulta $consulta, array $data)
    {
        $consulta = $this->consultaRepository->updateConsulta($consulta, $data);
        $this->notificador->notificar($consulta);
        return $consulta;
        
    }

    public function deleteConsulta(Consulta $consulta)
    {
        $this->consultaRepository->deleteConsulta($consulta);
        // Lógica para eliminar una consulta
    }
}