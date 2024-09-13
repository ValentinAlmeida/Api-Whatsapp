<?php

namespace App\Core\DTO;

class EditarContaDTO
{
    public function __construct(
        public ?string $token = null,
        public ?string $wa_id = null,
    ) {
    }
}
