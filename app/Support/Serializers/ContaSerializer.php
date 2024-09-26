<?php

namespace App\Support\Serializers;

use App\Core\Entidades\Conta;

class ContaSerializer
{
    public static function parseEntidade(Conta $entidade)
    {
        return [
            'id' => (int)$entidade->getIdentificador()->valor(),
            'wa_id' => $entidade->getWaId(),
            'token' => $entidade->getToken(),
            'nome' => $entidade->getNome(),
        ];
    }
}
