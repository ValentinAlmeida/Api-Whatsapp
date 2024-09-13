<?php

namespace App\Core\Entidades;

use App\Core\Entidade;
use App\Core\VO\Identificador;

class Conta extends Entidade
{
    private string $token;

    private string $waId;

    public static function build(
        int $id,
        string $token,
        string $wa_id,
    ): static {
        $instance = new static(new Identificador($id));
        $instance->token = $token;
        $instance->waId = $wa_id;

        return $instance;
    }
    public function token(): string
    {
        return $this->token;
    }

    public function wa_id(): string
    {
        return $this->waId;
    }
}
