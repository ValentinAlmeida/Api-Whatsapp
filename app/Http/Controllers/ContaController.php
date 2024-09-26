<?php

namespace App\Http\Controllers;

use App\Core\Contratos\Servicos\ContaService as Service;
use App\Core\Entidades\Conta as Entidade;
use App\Http\Requests\BuscarContaRequisicao as BuscarRequisicao;
use App\Http\Requests\CadastrarContaRequisicao as CadastrarRequisicao;
use App\Http\Requests\EditarContaRequisicao as EditarRequisicao;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Support\Serializers\ContaSerializer as Serializer;

class ContaController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(
        private readonly Service $service
    )
    {
    }
    public function cadastrar(CadastrarRequisicao $request)
    {
        return response(Serializer::parseEntidade($this->service->cadastrar($request->getData())));
    }
    public function editar(int $id, EditarRequisicao $request)
    {
        $this->service->editar($id, $request->getData());
    }

    public function buscar(BuscarRequisicao $request)
    {
        $entidades = $this->service->buscar($request->getData());

        return response(array_map(function (Entidade $entidade) {
            return Serializer::parseEntidade($entidade);
        }, $entidades));
    }

    public function consultarPorId(int $id)
    {
        return response(Serializer::parseEntidade($this->service->encontrarPorId($id)));
    }

    public function deletar(int $id)
    {
        $this->service->deletar($id);
    }
}
