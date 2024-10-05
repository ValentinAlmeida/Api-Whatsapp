<?php

namespace App\Support\Serializers;

use App\Core\Entidades\Log;

class LogSerializer
{
    public static function parseEntidade(Log $entidade)
    {
        return [
            'id' => $entidade->getId(),
            'mensagem' => $entidade->getMensagem(),
            'conta' => $entidade->getConta(),
            'data_cadastro' => $entidade->getDataCadastro(),
        ];
    }
}
