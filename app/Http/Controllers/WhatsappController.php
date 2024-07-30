<?php

namespace App\Http\Controllers;

use App\Core\Contratos\Servicos\WebhookService;
use App\Core\DTO\CadastrarWebhookDTO;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class WhatsappController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(Request $r)
    {
        $webhookService = App::make(WebhookService::class);

        $cadastrarDTO = new CadastrarWebhookDTO(
            'teste',
            'testando'
        );

        $entidade = $webhookService->cadastrar($cadastrarDTO);

        return ['hello' => $entidade];
    }
}
