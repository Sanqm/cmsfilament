<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
/*Rutas necesarias para el funcionamiento del laravel health y para monitorizacion de la actividad*/
use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;

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
     * Todo lo que se mete dentro de esta función correrá una unica vez por eso cada vez que 
     * realizemos algun cambio deberemos reiniciar la app 
     */
    public function boot(): void
    {
        App::setLocale('es'); // no me quedo más remedio fuerzo que el idioma este en español de los diferentes botones, cualquier otro 
        //boton que no se cambie has de ir al archivo es.json creado y agregar traduccion

        Health::checks([
            OptimizedAppCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
        ]);

    }
}
