<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrcamentoApiController;

Route::apiResource('orcamentos', OrcamentoApiController::class);

Route::get('/teste', function () {
    return ['status' => 'API funcionando'];
});
