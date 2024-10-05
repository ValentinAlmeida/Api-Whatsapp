<?php

namespace App\Core;

use App\Core\VO\Identificador;

abstract class Entidade
{
    public function __construct(private ?Identificador $identificador)
    {}

    public function equals(Object $outro): bool
    {
        if (!($outro instanceof Entidade)) {
            return false;
        }

        return $this->identificador->equals($outro->getIdentificador());
    }

    public function getIdentificador(): ?Identificador
    {
        return $this->identificador;
    }
}
