<?php

namespace App\Core\Negocios;

use DateTimeInterface;

class Conta
{
    public function __construct(
        public readonly int $id,
        public readonly string $token,
        public readonly string $wa_id,
        public readonly string $nome,
    ){
    }
}
