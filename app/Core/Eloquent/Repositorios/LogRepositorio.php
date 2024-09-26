<?php

namespace App\Core\Eloquent\Repositorios;

use App\Core\Adapter\LogAdapter;
use App\Core\Contratos\Repositorios\LogRepositorio as Contrato;
use App\Core\Entidades\Log as Entidade;
use App\Core\Filtros\LogFiltro as Filtro;
use App\Models\Log as Model;

class LogRepositorio implements Contrato
{
    public function criar(Entidade $dados): Entidade
    {
        $model = Model::create([
            Model::MENSAGEM => $dados->getMensagem(),
            Model::CONTA_ID => $dados->getContaRef(),
        ]);

        return LogAdapter::converter($model);
    }

    public function buscar(Filtro $filtro): array
    {
        $query = Model::query();

        if (!empty($filtro->conta_id)) {
            $query->where(Model::CONTA_ID, $filtro->conta_id);
        }

        $entidades = $query->get();

        return $entidades->map(function (Model $model) {
            return LogAdapter::converter($model);
        })->toArray();
    }
}
