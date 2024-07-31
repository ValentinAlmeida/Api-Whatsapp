<?php

namespace App\Core\Excecoes\Recursos;

use App\Core\Excecoes\Excecao;

class ContatoExcecao extends Excecao
{
    const NAME  = 'contato';

    public static function naoEncontrado() {
        return new static(self::NAME, '101');
    }
}
