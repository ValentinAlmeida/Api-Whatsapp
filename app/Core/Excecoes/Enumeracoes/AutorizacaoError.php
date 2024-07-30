<?php

namespace App\Core\Excecoes\Enumeracoes;

use App\Core\Excecoes\Contratos\Enumeracao;

enum AutorizacaoError: string implements Enumeracao
{
    case NAO_AUTORIZADO = '301';

    public function codigo(): string
    {
        return $this->value;
    }

    public function mensagem(): string
    {
        return match ($this) {
            self::NAO_AUTORIZADO => 'Não autorizado',
        };
    }
}
