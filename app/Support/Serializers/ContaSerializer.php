<?php

namespace App\Support\Serializers;

use App\Core\Negocios\Conta as Negocio;

class ContaSerializer
{
    public static function parseEntidade(Negocio $entidade)
    {
        return [
            'id' => $entidade->id,
            'wa_id' => $entidade->wa_id,
            'token' => $entidade->token,
        ];
    }
}
