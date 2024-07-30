<?php

namespace App\Http\Controllers;

use App\Core\Contratos\Servicos\WebhookService;
use App\Http\Requests\CadastrarWebhookRequisicao;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Support\Serializers\WebhookSerializer as Serializer;
use Illuminate\Support\Facades\App;

class WebhookController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function cadastrar(CadastrarWebhookRequisicao $request)
    {
        $webhookService = App::make(WebhookService::class);

        return response(Serializer::parseEntidade($webhookService->cadastrar($request->getData())));
    }
}
