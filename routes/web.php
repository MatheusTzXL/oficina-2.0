<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrcamentoController;

Route::get('/', function () {
    return redirect()->route('orcamentos.index');
});

Route::resource('orcamentos', OrcamentoController::class);
