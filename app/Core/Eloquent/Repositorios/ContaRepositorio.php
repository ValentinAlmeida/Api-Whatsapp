<?php

namespace App\Core\Eloquent\Repositorios;

use App\Core\Adapter\ContaAdapter;
use App\Core\Contratos\Repositorios\ContaRepositorio as Contrato;
use App\Core\Entidades\Conta as Entidade;
use App\Core\Excecoes\Recursos\ContaExcecao as Excecao;
use App\Core\Filtros\ContaFiltros as Filtro;
use App\Models\Conta as Model;

class ContaRepositorio implements Contrato
{
    public function criar(Entidade $dados): Entidade
    {
        $entidade = Model::create([
            Model::TOKEN => $dados->getToken(),
            Model::WA_ID => $dados->getWaId(),
            Model::NOME => $dados->getNome(),
        ]);

        return ContaAdapter::converter($entidade);
    }

    public function buscar(Filtro $filtro): array
    {
        $query = Model::query();

        if (!empty($filtro->token)) {
            $query->where(Model::TOKEN, $filtro->token);
        }

        if (!empty($filtro->waId)) {
            $query->where(Model::WA_ID, $filtro->waId);
        }

        if (!empty($filtro->nome)) {
            $query->where(Model::NOME, $filtro->nome);
        }

        $entidades = $query->get();

        return $entidades->map(function (Model $entidade) {
            return ContaAdapter::converter($entidade);
        })->toArray();
    }

    public function encontrarPorId(int $id): Entidade
    {
        $entidade = Model::find($id);

        throw_if(!$entidade, Excecao::naoEncontrado());

        return ContaAdapter::converter($entidade);
    }

    public function editar(int $id, Entidade $entidade): void
    {
        $model = Model::find($id);

        throw_if(!$model, Excecao::naoEncontrado());

        $model->update([
            Model::WA_ID => $entidade->getWaId(),
            Model::TOKEN => $entidade->getToken(),
            Model::NOME => $entidade->getNome(),
        ]);
    }

    public function deletar(int $id): void
    {
        $entidade = Model::find($id);

        throw_if(!$entidade, Excecao::naoEncontrado());

        $entidade->delete();
    }
}
