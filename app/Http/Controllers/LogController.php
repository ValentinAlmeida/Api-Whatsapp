<?php

namespace App\Http\Controllers;

use App\Core\Contratos\Servicos\LogService as Service;
use App\Core\Entidades\Log;
use App\Http\Requests\BuscarLogRequisicao as BuscarRequisicao;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Support\Serializers\LogSerializer as Serializer;

class LogController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(
        private readonly Service $service
    )
    {
    }

    public function buscar(BuscarRequisicao $request)
    {
        $entidades = $this->service->buscar($request->getData());

        return response(array_map(function (Log $entidade) {
            return Serializer::parseEntidade($entidade);
        }, $entidades));
    }
}
