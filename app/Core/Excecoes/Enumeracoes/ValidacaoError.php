<?php

namespace App\Core\Excecoes\Enumeracoes;

use App\Core\Excecoes\Contratos\Enumeracao;

enum ValidacaoError: string implements Enumeracao
{
    case VALIDACAO_REQUISICAO = '401';

    public function codigo(): string
    {
        return $this->value;
    }

    public function mensagem(): string
    {
        return match ($this) {
            self::VALIDACAO_REQUISICAO => 'Erro de validação',
        };
    }
}
