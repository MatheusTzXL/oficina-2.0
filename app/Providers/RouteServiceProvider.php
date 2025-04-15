<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Namespace para os controladores.
     *
     * @var string
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Inicializa qualquer serviço de rotas.
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Mapeia as rotas da aplicação.
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Mapeia as rotas para a interface web.
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Mapeia as rotas para a API.
     */
    protected function mapApiRoutes()
    {
        Route::middleware('api')
         ->namespace($this->namespace . '\Api')
         ->group(base_path('routes/api.php'));
    }
}

