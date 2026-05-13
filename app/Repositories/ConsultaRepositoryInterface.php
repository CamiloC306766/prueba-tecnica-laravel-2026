<?php

namespace App\Repositories;
use App\Models\Consulta;

interface ConsultaRepositoryInterface
{
    public function getConsultas($estado);

    public function createConsulta(array $data);

    public function getOneConsulta(Consulta $consulta);

    public function updateConsulta(Consulta $consulta, array $data);

    public function deleteConsulta(Consulta $consulta);
}