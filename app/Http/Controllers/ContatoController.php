<?php

namespace App\Http\Controllers;

use App\Core\Contratos\Servicos\ContatoService;
use App\Core\Negocios\Contato as Negocio;
use App\Http\Requests\BuscarContatoRequisicao as BuscarRequisicao;
use App\Http\Requests\CadastrarContatoRequisicao as CadastrarRequisicao;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Support\Serializers\ContatoSerializer as Serializer;

class ContatoController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(
        private readonly ContatoService $service
    )
    {
    }
    public function cadastrar(CadastrarRequisicao $request)
    {
        return response(Serializer::parseEntidade($this->service->cadastrar($request->getData())));
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
