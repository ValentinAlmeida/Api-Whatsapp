<?php

namespace App\Core\Filtros;

use DateTimeInterface;

class MensagemFiltros extends Filtro
{
    public ?string $nome;
    public ?string $mensagem;
    public ?int $telefone;
    public ?int $contato_id;
    public ?DateTimeInterface $data_envio;
}
