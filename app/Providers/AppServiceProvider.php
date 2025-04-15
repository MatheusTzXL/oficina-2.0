<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra os serviços da aplicação.
     */
    public function register(): void
    {
        //
    }

    /**
     * Inicializa os serviços da aplicação, como rotas.
     */
    public function boot(): void
    {
        Route::prefix('api')
             ->group(base_path('routes/api.php'));
    }
}
