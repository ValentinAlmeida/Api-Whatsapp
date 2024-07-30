<?php

namespace App\Core\Entidades;

use App\Core\Contratos\Autenticavel;
use App\Core\Entidade;
use App\Core\VO\Identificador;

class Usuario extends Entidade implements Autenticavel
{
    public int $id;
    public string $nome;

    public string $email;

    public string $senha;

    public static function build(
        int $id,
        string $nome,
        string $email,
        string $senha,
    ) {
        $instance = new static(new Identificador($id));
        $instance->nome = $nome;
        $instance->email = $email;
        $instance->senha = $senha;

        return $instance;
    }

    public function email(): string
    {
        return $this->email;
    }
    public function nome(): string
    {
        return $this->nome;
    }
}
