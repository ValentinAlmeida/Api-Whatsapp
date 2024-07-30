<?php

namespace App\Core\DTO;

class CadastrarWebhookDTO
{
    public function __construct(
        public ?string $webhook,
        public ?string $type,
        public ?string $hub_challenge = null
    ) {
    }
}
