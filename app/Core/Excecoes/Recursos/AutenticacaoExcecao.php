<?php

namespace App\Core\Excecoes\Recursos;

use Exception;

class AutenticacaoExcecao extends Exception
{
    protected function __construct(
        public readonly string $codigo,
        public readonly ?string $token = null,
        public readonly ?\Throwable $previous = null,
    ) {
    }

    public static function credenciaisInvalidas()
    {
        return new static('201');
    }

    public static function tokenNaoEncontrado()
    {
        return new static('202');
    }

    public static function tokenInvalido(string $token)
    {
        return new static('203', $token);
    }

    public static function tokenExpirado(string $token)
    {
        return new static('204', $token);
    }

    public static function acessoBloqueado() {
        return new static('205');
    }
}
