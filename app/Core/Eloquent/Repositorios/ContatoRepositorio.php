<?php

namespace App\Core\Eloquent\Repositorios;

use App\Core\Contratos\Repositorios\ContatoRepositorio as Contrato;
use App\Core\DTO\CadastrarContatoDTO as CadastrarDTO;
use App\Core\Entidades\Contato as Entidade;
use App\Core\Filtros\ContatoFiltro as Filtro;
use App\Models\Contato as Model;

class ContatoRepositorio implements Contrato
{
    public function criar(CadastrarDTO $dados): Entidade
    {
        $entidade = Model::updateOrCreate([
            Model::NOME => $dados->nome,
            Model::TELEFONE => $dados->telefone,
        ]);

        return Entidade::build(
            $entidade->id,
            $entidade->nome,
            $entidade->telefone,
            $entidade->created_at,
        );
    }

    public function buscar(Filtro $filtro): array
    {
        $query = Model::query();

        if (!empty($filtro->nome)) {
            $query->where('nome', $filtro->nome);
        }

        if (!empty($filtro->telefone)) {
            $query->where('telefone', $filtro->telefone);
        }

        $entidades = $query->get();

        return $entidades->map(function ($entidade) {
            return Entidade::build(
                $entidade->id,
                $entidade->nome,
                $entidade->telefone,
                $entidade->created_at,
            );
        })->toArray();
    }
}
