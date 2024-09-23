<?php

namespace App\Http\Controllers;

use App\Core\Contratos\Servicos\ContaService;
use App\Core\Contratos\Servicos\MensagemService as Service;
use App\Core\Negocios\Mensagem as Negocio;
use App\Http\Requests\BuscarMensagemRequisicao as BuscarRequisicao;
use App\Http\Requests\CadastrarMensagemRequisicao as CadastrarRequisicao;
use App\Http\Requests\EnviarMensagemRequisicao;
use App\Http\Requests\EnviarVariasMensagemRequisicao;
use App\Infra\Mensagem\EnvioMensagem;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Support\Serializers\MensagemSerializer as Serializer;
use Illuminate\Support\Facades\App;

class MensagemController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(
        private readonly Service $service
    )
    {
    }
    public function cadastrar(CadastrarRequisicao $request, int $contatoId)
    {
        return response(Serializer::parseEntidade($this->service->cadastrar($request->getData(), $contatoId)));
    }

    public function buscar(BuscarRequisicao $request)
    {
        $entidades = $this->service->buscar($request->getData());

        return response(array_map(function (Negocio $entidade) {
            return Serializer::parseEntidade($entidade);
        }, $entidades));
    }

    public function consultarPorId(int $id)
    {
        return response(Serializer::parseEntidade($this->service->encontrarPorId($id)));
    }

    public function enviarMensagem(EnviarMensagemRequisicao $request)
    {
        $envioMensagem = new EnvioMensagem();

        $contaService = App::make(ContaService::class);
        return $envioMensagem->enviarMensagem($request->getData(), $contaService->encontrarPorId($request->getConta()));
    }

    public function multiplasMensagens(int $template_id, EnviarVariasMensagemRequisicao $request)
    {
        $envioMensagem = new EnvioMensagem();
        return $envioMensagem->enviarVariasMensagens($request->getData(), $template_id);
    }
}
