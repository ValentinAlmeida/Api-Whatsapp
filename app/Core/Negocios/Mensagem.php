<?php

namespace App\Core\Negocios;

use DateTimeInterface;

class Mensagem
{
    public function __construct(
        public readonly int $id,
        public readonly ?int $telefone,
        public readonly ?string $mensagem,
        public readonly ?string $tipo,
        public readonly ?Contato $contato,
        public ?DateTimeInterface $data_cadastro,
        public ?DateTimeInterface $data_envio,
    )
    {
    }
}
