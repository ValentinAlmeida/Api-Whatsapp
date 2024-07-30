<?php

namespace App\Http\Controllers;

use App\Core\Contratos\Servicos\WebhookService;
use App\Core\DTO\CadastrarWebhookDTO;
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
        $entidade = $webhookService->cadastrar($request->getData());

        return response(Serializer::parseEntidade($entidade));
    }
}
