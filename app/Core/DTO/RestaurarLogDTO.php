<?php

namespace App\Core\DTO;

use DateTimeInterface;

class RestaurarLogDTO
{
    public function __construct(
        public string $mensagem,
        public int $contaRef,
        public DateTimeInterface $data_cadastro,
    ) {
    }
}
