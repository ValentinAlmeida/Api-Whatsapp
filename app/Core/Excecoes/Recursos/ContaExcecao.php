<?php

namespace App\Core\Excecoes\Recursos;

use App\Core\Excecoes\Excecao;

class ContaExcecao extends Excecao
{
    const NAME  = 'conta';

    public static function naoEncontrado() {
        return new static(self::NAME, '101');
    }
}
