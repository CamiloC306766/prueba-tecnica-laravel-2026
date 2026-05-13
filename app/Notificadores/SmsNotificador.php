<?php

namespace App\Notificadores;

use App\Models\Consulta;
use Illuminate\Support\Facades\Log;
use App\Contracts\NotificacionInterface;

class SmsNotificador implements NotificacionInterface
{
    public function notificar(Consulta $consulta): void
    {
        Log::info('Notificación por SMS enviada', [
            'consulta_id' => $consulta->id,
            'mascota' => $consulta->mascota->nombre ?? 'desconocida',
            'canal' => 'sms',
        ]);
    }
}
