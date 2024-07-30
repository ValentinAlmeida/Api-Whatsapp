<?php

namespace App\Core\Excecoes\Enumeracoes;

use App\Core\Excecoes\Contratos\Enumeracao;

enum RecursoError: string implements Enumeracao
{
    case NAO_ENCONTRADO = '101';
    case JA_EXISTE = '102';
    case NAO_PODE_CRIAR = '103';
    case NAO_PODE_ATUALIZAR = '104';
    case NAO_PODE_DELETAR = '105';

    public function codigo(): string
    {
        return $this->value;
    }

    public function mensagem(): string
    {
        return match ($this) {
            self::NAO_ENCONTRADO => 'Recurso não encontrado',
            self::JA_EXISTE => 'Recurso já existe',
            self::NAO_PODE_CRIAR => 'Recurso não pode ser criado',
            self::NAO_PODE_ATUALIZAR => 'Recurso não pode ser atualizado',
            self::NAO_PODE_DELETAR => 'Recurso não pode ser deletado',
        };
    }

    public static function pertence(string $value)
    {
        return match ($value) {
            self::NAO_ENCONTRADO->codigo() => true,
            self::JA_EXISTE->codigo() => true,
            self::NAO_PODE_CRIAR->codigo() => true,
            self::NAO_PODE_ATUALIZAR->codigo() => true,
            self::NAO_PODE_DELETAR->codigo() => true,
            default => false
        };
    }
}
