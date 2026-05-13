<?php

namespace App\Contracts;
use App\Models\Consulta;
interface NotificacionInterface
{
    public function notificar(Consulta $consulta): void;
}
