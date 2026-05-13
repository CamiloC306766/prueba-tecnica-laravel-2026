<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ConsultaRepositoryInterface;
use App\Repositories\ConsultaRepository;
use App\Strategy\NotificacionStrategy;
use App\Contracts\NotificacionInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ConsultaRepositoryInterface::class, ConsultaRepository::class);
        $this->app->bind(NotificacionInterface::class, function ($app) {
            return $app->make(NotificacionStrategy::class)->make();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
