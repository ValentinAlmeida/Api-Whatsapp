<?php

namespace App\Support\Serializers;

use App\Core\Negocios\Contato as Negocio;

class ContatoSerializer
{
    public static function parseEntidade(Negocio $entidade)
    {
        return [
            'id' => $entidade->id,
            'nome' => $entidade->nome,
            'telefone' => $entidade->telefone,
            'data_cadastro' => $entidade->data_cadastro
        ];
    }
}
