<?php

namespace App\Core\Negocios;

use DateTimeInterface;

class Webhook
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $webhook,
        public readonly ?string $type,
        public ?DateTimeInterface $data_cadastro,
    )
    {
    }
}
