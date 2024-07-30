<?php

use App\Http\Controllers\AutenticacaoController;
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

Route::middleware('auth.refact')->group(function () {
    Route::get('/example', function () {
        return response()->json(['message' => 'This is an example API route']);
    });
});
