<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        // Dinámicamente establece APP_URL basado en la solicitud actual
        if (!app()->environment("local")) {
            // Solo en producción/staging
            URL::forceRootUrl(
                Request::getSchemeAndHttpHost() . "/IntroduccionMarsiServicio"
            );

            // Opcional: Si tu instalación está en una subcarpeta (ej: /servicio)
            // URL::forceRootUrl(Request::getSchemeAndHttpHost() . '/servicio');
        }
    }
}
