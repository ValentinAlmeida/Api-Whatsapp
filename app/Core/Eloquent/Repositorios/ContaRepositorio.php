<?php

namespace App\Core\Eloquent\Repositorios;

use App\Core\Contratos\Repositorios\ContaRepositorio as Contrato;
use App\Core\DTO\CadastrarContaDTO as CadastrarDTO;
use App\Core\DTO\EditarContaDTO;
use App\Core\Entidades\Conta as Entidade;
use App\Core\Excecoes\Recursos\ContaExcecao as Excecao;
use App\Core\Filtros\ContaFiltros as Filtro;
use App\Models\Conta as Model;

class ContaRepositorio implements Contrato
{
    public function criar(CadastrarDTO $dados): Entidade
    {
        $entidade = Model::create([
            Model::TOKEN => $dados->token,
            Model::WA_ID => $dados->wa_id,
        ]);

        return Entidade::build(
            $entidade->id,
            $entidade->token,
            $entidade->wa_id,
        );
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

        $entidades = $query->get();

        return $entidades->map(function ($entidade) {
            return Entidade::build(
                $entidade->id,
                $entidade->token,
                $entidade->wa_id,
            );
        })->toArray();
    }

    public function encontrarPorId(int $id): Entidade
    {
        /** @var Model */
        $entidade = Model::find($id);

        throw_if(!$entidade, Excecao::naoEncontrado());

        return Entidade::build(
            $entidade->id,
            $entidade->token,
            $entidade->wa_id,
        );
    }

    public function editar(int $id, EditarContaDTO $dados): void
    {
        $entidade = Model::find($id);

        throw_if(!$entidade, Excecao::naoEncontrado());

        $entidade->wa_id = $dados->wa_id ?? $entidade->wa_id;
        $entidade->token = $dados->token ?? $entidade->token;

        $entidade->save();
    }
}
