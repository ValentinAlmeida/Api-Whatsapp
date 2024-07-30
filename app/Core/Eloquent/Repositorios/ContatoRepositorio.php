<?php

namespace App\Core\Eloquent\Repositorios;

use App\Core\Contratos\Repositorios\ContatoRepositorio as Contrato;
use App\Core\DTO\CadastrarContatoDTO as CadastrarDTO;
use App\Core\Entidades\Contato as Entidade;
use App\Models\Contato as Model;

class ContatoRepositorio implements Contrato
{
    public function criar(CadastrarDTO $dados): Entidade
    {
        $entidade = Model::create([
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
}
