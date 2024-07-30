<?php

namespace App\Core\Contratos;

use \DateTimeInterface;

interface Token
{
    function getExpiracao(): DateTimeInterface;

    function getTipo(): string;

    function toString(): string;
}
