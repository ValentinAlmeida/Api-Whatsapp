<?php

namespace App\Core\DTO;

class EnviarMensagemDTO
{
    public function __construct(
        public int $telefone,
        public ?string $nome,
        public ?string $cnpj
    ) {
    }
}
