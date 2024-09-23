<?php

namespace App\Core\Entidades;

use App\Core\Entidade;
use App\Core\Negocios\Contato;
use App\Core\VO\Identificador;
use DateTimeInterface;

class Mensagem extends Entidade
{
    public ?int $telefone;

    public ?string $mensagem;

    public ?string $tipo;

    public ?Contato $contato;

    public ?DateTimeInterface $data_recuperacao;

    public ?DateTimeInterface $data_envio;

    public static function build(
        int $id,
        ?int $telefone,
        ?string $mensagem,
        ?string $tipo,
        ?Contato $contato,
        ?DateTimeInterface $data_recuperacao,
        ?DateTimeInterface $data_envio
    ): static {
        $instance = new static(new Identificador($id));
        $instance->telefone = $telefone;
        $instance->mensagem = $mensagem;
        $instance->tipo = $tipo;
        $instance->contato = $contato;
        $instance->data_recuperacao = $data_recuperacao;
        $instance->data_envio = $data_envio;

        return $instance;
    }

    public function telefone(): ?int
    {
        return $this->telefone;
    }
    public function mensagem(): ?string
    {
        return $this->mensagem;
    }

    public function tipo(): ?string
    {
        return $this->tipo;
    }

    public function contato(): ?Contato
    {
        return $this->contato;
    }

    public function dataRecuperacao(): ?DateTimeInterface
    {
        return $this->data_recuperacao;
    }

    public function dataEnvio(): ?DateTimeInterface
    {
        return $this->data_envio;
    }
}
