<?php

namespace App\Core\Entidades;

use App\Core\Entidade;
use App\Core\VO\Identificador;

class Conta extends Entidade
{
    private string $token;

    private string $waId;
    private string $nome;

    public static function build(
        int $id,
        string $token,
        string $wa_id,
        string $nome,
    ): static {
        $instance = new static(new Identificador($id));
        $instance->token = $token;
        $instance->waId = $wa_id;
        $instance->nome = $nome;

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

    public function nome(): string
    {
        return $this->nome;
    }
}
