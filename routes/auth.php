<?php

use App\Http\Controllers\AutenticacaoController;
use Illuminate\Support\Facades\Route;


Route::post('/autenticar', [AutenticacaoController::class, 'autenticar']);
