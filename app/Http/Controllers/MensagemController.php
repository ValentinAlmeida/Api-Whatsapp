<?php

namespace App\Http\Controllers;

use App\Core\Contratos\Servicos\MensagemService as Service;
use App\Core\Negocios\Mensagem as Negocio;
use App\Http\Requests\BuscarMensagemRequisicao as BuscarRequisicao;
use App\Http\Requests\CadastrarMensagemRequisicao as CadastrarRequisicao;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Support\Serializers\MensagemSerializer as Serializer;

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
}