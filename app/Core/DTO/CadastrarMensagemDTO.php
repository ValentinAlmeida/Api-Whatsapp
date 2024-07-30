<?php

namespace App\Core\DTO;

use DateTimeInterface;

class CadastrarMensagemDTO
{
    public function __construct(
        public ?int $telefone,
        public ?string $mensagem,
        public ?string $tipo,
        public ?int $contato_id,
        public ?DateTimeInterface $data_envio,
    ) {
    }
}
