<?php

namespace App\Core\Excecoes\Enumeracoes;

use App\Core\Excecoes\Contratos\Enumeracao;

enum AutenticacaoError: string implements Enumeracao
{
    case CREDENCIAIS_INVALIDAS = '201';
    case TOKEN_NAO_ENCONTRADO = '202';
    case TOKEN_INVALIDO = '203';
    case TOKEN_EXPIRADO = '204';
    case ACESSO_BLOQUEADO = '205';

    public function codigo(): string
    {
        return $this->value;
    }

    public function mensagem(): string
    {
        return match ($this) {
            self::CREDENCIAIS_INVALIDAS => 'Credenciais inválida',
            self::TOKEN_NAO_ENCONTRADO => 'Token não encontrado',
            self::TOKEN_INVALIDO => 'Token inválido',
            self::TOKEN_EXPIRADO => 'Token expirado',
            self::ACESSO_BLOQUEADO => 'Acesso bloqueado',
        };
    }
}
