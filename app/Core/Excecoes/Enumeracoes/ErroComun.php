<?php

namespace App\Core\Excecoes\Enumeracoes;

use App\Core\Excecoes\Contratos\Enumeracao;

enum ErroComun: string implements Enumeracao {
    case ERRO_INTERNO = '001';

    public function codigo(): string
    {
        return $this->value;
    }

    public function mensagem(): string
    {
        return match($this) {
            self::ERRO_INTERNO => 'Um erro desconhecido ocorreu',
        };
    }
}
