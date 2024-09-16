<?php

use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\MensagemController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/autenticar', [AutenticacaoController::class, 'autenticar']);

Route::get('/whatsapp', [WebhookController::class, 'cadastrar']);
Route::post('/whatsapp', [WebhookController::class, 'cadastrar']);

Route::prefix('/contato')->group(function () {
    Route::get('/', [ContatoController::class, 'buscar']);
    Route::get('/{contatoId}', [ContatoController::class, 'consultarPorId']);
    Route::post('/', [ContatoController::class, 'cadastrar']);
});

Route::prefix('/conta')->group(function () {
    Route::get('/', [ContaController::class, 'buscar']);
    Route::get('/{contaId}', [ContaController::class, 'consultarPorId']);
    Route::post('/', [ContaController::class, 'cadastrar']);
    Route::put('/{contaId}', [ContaController::class, 'editar']);
});

Route::prefix('/mensagem')->group(function () {
    Route::get('/', [MensagemController::class, 'buscar']);
    Route::post('/enviar', [MensagemController::class, 'enviarMensagem']);
    Route::post('/enviar/varias/{templateId}', [MensagemController::class, 'multiplasMensagens']);
    Route::get('/{mensagemId}', [MensagemController::class, 'consultarPorId']);
    Route::post('/{contatoId}', [MensagemController::class, 'cadastrar']);
});

Route::middleware('auth.refact')->group(function () {
    Route::get('/example', function () {
        return response()->json(['message' => 'This is an example API route']);
    });
});
