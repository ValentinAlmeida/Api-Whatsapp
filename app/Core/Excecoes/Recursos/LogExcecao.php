<?php

namespace App\Core\Excecoes\Recursos;

use App\Core\Excecoes\Excecao;

class LogExcecao extends Excecao
{
    const NAME  = 'log';

    public static function naoEncontrado() {
        return new static(self::NAME, '101');
    }
}
