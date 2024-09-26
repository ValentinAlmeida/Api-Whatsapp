<?php

namespace App\Core\DTO;

class CadastrarLogDTO
{
    public function __construct(
        public ?string $mensagem,
        public ?int $conta_id
    ) {
    }
}
