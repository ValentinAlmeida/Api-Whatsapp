<?php

namespace App\Core\Propriedade;

use App\Core\Entidades\Conta;
use DateTimeInterface;

class LogPropriedade
{
    public function __construct(
        public ?string $mensagem = null,
        public ?int $contaRef = null,
        public ?Conta $conta = null,
        public ?DateTimeInterface $data_cadastro = null,
    ) {
    }
}
