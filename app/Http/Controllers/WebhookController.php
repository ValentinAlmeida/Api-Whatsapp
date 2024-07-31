<?php

namespace App\Http\Controllers;

use App\Core\Contratos\Servicos\ContatoService;
use App\Core\Contratos\Servicos\WebhookService;
use App\Http\Requests\BuscarContatoRequisicao;
use App\Http\Requests\CadastrarWebhookRequisicao;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Support\Serializers\WebhookSerializer as Serializer;
use Illuminate\Support\Facades\App;

class WebhookController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(
        private readonly WebhookService $service
    )
    {
    }

    public function cadastrar(CadastrarWebhookRequisicao $request)
    {
        $entidade = $this->service->cadastrar(
            $request->getData(),
            $request->getDataContact(),
            $request->getDataMensage()
        );

        return $entidade->hub_challenge;
    }
}
