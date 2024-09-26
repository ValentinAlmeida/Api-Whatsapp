<?php

namespace App\Support\Serializers;

use App\Core\Entidades\Log;

class LogSerializer
{
    public static function parseEntidade(Log $entidade)
    {
        return [
            'id' => (int)$entidade->getIdentificador()->valor(),
            'mensagem' => $entidade->getMensagem(),
            'conta' => $entidade->getConta(),
        ];
    }
}