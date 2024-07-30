<?php

namespace App\Core\VO;

class Identificador
{
    private string $identificador;

    public function __construct(string $valor)
    {
        $this->identificador = $valor;
    }

    public static function create(string $valor): Identificador
    {
        return new static($valor);
    }

    public function valor(): string
    {
        return $this->identificador;
    }

    public function toString(): string
    {
        return $this->valor();
    }

    public function isEmpty(): bool
    {
        return strlen($this->valor()) == 0;
    }


    public function equals(Object $outro): bool
    {
        if (!($outro instanceof Identificador)) {
            return false;
        }

        if ($this->isEmpty()) {
            return false;
        }

        return strcmp($this->valor(), $outro->valor()) == 0;
    }
}
