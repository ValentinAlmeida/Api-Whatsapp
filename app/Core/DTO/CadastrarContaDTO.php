<?php

namespace App\Core\DTO;

class CadastrarContaDTO
{
    public function __construct(
        public string $token,
        public string $wa_id,
        public string $nome,
    ) {
    }
}
