<?php

namespace App\Core\Propriedade;

class ContaPropriedade
{
    public function __construct(
        public ?string $token = null,
        public ?string $waId = null,
        public ?string $nome = null,
    ) {
    }
}
