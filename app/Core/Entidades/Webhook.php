<?php

namespace App\Core\Entidades;

use App\Core\Entidade;
use App\Core\VO\Identificador;
use DateTimeInterface;

class Webhook extends Entidade
{
    public ?string $webhook;

    public ?string $hub_challenge = null;

    public ?string $type;

    public ?DateTimeInterface $data_recuperacao;

    public static function build(
        int $id,
        ?string $webhook,
        ?string $type,
        ?DateTimeInterface $data_recuperacao,
        ?string $hub_challenge = null,
    ) {
        $instance = new static(new Identificador($id));
        $instance->webhook = $webhook;
        $instance->type = $type;
        $instance->data_recuperacao = $data_recuperacao;
        $instance->hub_challenge = $hub_challenge;

        return $instance;
    }

    public function webhook(): ?string
    {
        return $this->webhook;
    }
    public function type(): ?string
    {
        return $this->type;
    }

    public function dataRecuperacao(): ?DateTimeInterface
    {
        return $this->data_recuperacao;
    }

    public function hubChallenge(): ?string
    {
        return $this->hub_challenge;
    }
}
