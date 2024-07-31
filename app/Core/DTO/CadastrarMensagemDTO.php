<?php

namespace App\Core\DTO;

use DateTimeInterface;

class CadastrarMensagemDTO
{
    public function __construct(
        public ?int $telefone,
        public ?string $mensagem,
        public ?string $tipo,
        public ?DateTimeInterface $data_envio,
        public ?int $contato_id = null,
    ) {
    }
}
