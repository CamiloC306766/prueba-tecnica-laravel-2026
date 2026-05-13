<?php

namespace App\Strategy;
use App\Contracts\NotificacionInterface;
use Illuminate\Container\Container;
use App\Notificadores\SmsNotificador;
use App\Notificadores\MailNotificador;

class NotificacionStrategy
{
    public function __construct(protected Container $app)
    {
    
    }

    public function make(?string $notificacion = null): NotificacionInterface
    {
        $notificacion = $notificacion ?? config('okvet.notificador', 'sms');

        return match ($notificacion) {
            'sms' => $this->app->make(SmsNotificador::class),
            'mail' => $this->app->make(MailNotificador::class),
            default => $this->app->make(SmsNotificador::class),
        };
    }

}