<?php

namespace App\Core\DTO;

class RestaurarContaDTO
{
    public function __construct(
        public string $nome,
        public string $token,
        public string $wa_id,
    ) {
    }
}
