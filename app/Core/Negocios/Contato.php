<?php

namespace App\Core\Negocios;

use DateTimeInterface;

class Contato
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $nome,
        public readonly ?int $telefone,
        public ?DateTimeInterface $data_cadastro,
    )
    {
    }
}
