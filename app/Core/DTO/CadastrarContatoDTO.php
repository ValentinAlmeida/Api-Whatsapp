<?php

namespace App\Core\DTO;

class CadastrarContatoDTO
{
    public function __construct(
        public ?string $nome,
        public ?int $telefone
    ) {
    }
}
