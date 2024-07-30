<?php

namespace App\Core\Entidades;

use App\Core\Entidade;
use App\Core\VO\Identificador;
use DateTimeInterface;

class Contato extends Entidade
{
    public ?string $nome;

    public ?int $telefone;

    public ?DateTimeInterface $data_recuperacao;

    public static function build(
        int $id,
        ?string $nome,
        ?int $telefone,
        ?DateTimeInterface $data_recuperacao
    ) {
        $instance = new static(new Identificador($id));
        $instance->nome = $nome;
        $instance->telefone = $telefone;
        $instance->data_recuperacao = $data_recuperacao;

        return $instance;
    }

    public function nome(): ?string
    {
        return $this->nome;
    }
    public function telefone(): ?int
    {
        return $this->telefone;
    }

    public function dataRecuperacao(): ?DateTimeInterface
    {
        return $this->data_recuperacao;
    }
}
