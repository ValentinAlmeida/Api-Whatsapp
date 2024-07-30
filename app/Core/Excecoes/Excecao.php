<?php

namespace App\Core\Excecoes;

use Exception;

abstract class Excecao extends Exception
{
    protected function __construct(
        public readonly string $recurso,
        public readonly string $codigo,
        public readonly ?string $campo = null,
        public readonly ?string $justificativa = null,
    ) {
    }
}
