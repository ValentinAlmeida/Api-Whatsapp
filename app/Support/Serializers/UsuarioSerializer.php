<?php

namespace App\Support\Serializers;

use App\Constantes\Format;
use App\Core\Contratos\Autenticavel;
use App\Core\Contratos\Token;

class UsuarioSerializer
{
    public static function parseEntidade(Autenticavel $autenticado, Token $token)
    {
        return response([
            'usuario' => [
                'nome' => $autenticado->nome(),
                'email' => $autenticado->email(),
            ],
            'token' => $token->toString(),
            'expira_em' => $token->getExpiracao()->format(Format::DATE_TIME),
        ], 200);
    }
}
