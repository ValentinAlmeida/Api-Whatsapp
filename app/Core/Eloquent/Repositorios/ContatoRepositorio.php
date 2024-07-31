<?php

namespace App\Core\Eloquent\Repositorios;

use App\Core\Contratos\Repositorios\ContatoRepositorio as Contrato;
use App\Core\DTO\CadastrarContatoDTO as CadastrarDTO;
use App\Core\Entidades\Contato as Entidade;
use App\Core\Excecoes\Recursos\ContatoExcecao as Excecao;
use App\Core\Filtros\ContatoFiltros as Filtro;
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

        if (!empty($filtro->id)) {
            $query->where('id', $filtro->id);
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
    
    public function encontrarPorId(int $id): Entidade
    {
        /** @var Model */
        $entidade = Model::find($id);

        throw_if(!$entidade, Excecao::naoEncontrado());

        return Entidade::build(
            $entidade->id,
            $entidade->nome,
            $entidade->telefone,
            $entidade->created_at,
        );
    }
}
