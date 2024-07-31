<?php

namespace App\Support\Serializers;

use App\Core\Negocios\Mensagem as Negocio;

class MensagemSerializer
{
    public static function parseEntidade(Negocio $entidade)
    {
        return [
            'id' => $entidade->id,
            'mensagem' => $entidade->mensagem,
            'telefone' => $entidade->telefone,
            'tipo' => $entidade->tipo,
            'contato' => $entidade->contato,
            'data_cadastro' => $entidade->data_cadastro,
            'data_envio' => $entidade->data_envio,
        ];
    }
}
