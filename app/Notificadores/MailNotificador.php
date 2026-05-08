<?php

namespace App\Notificadores;

use App\Models\Consulta;
use Illuminate\Support\Facades\Log;

class MailNotificador
{
    public function notificar(Consulta $consulta): void
    {
        Log::info('Notificación por correo enviada', [
            'consulta_id' => $consulta->id,
            'mascota' => $consulta->mascota->nombre ?? 'desconocida',
            'canal' => 'mail',
        ]);
    }
}
