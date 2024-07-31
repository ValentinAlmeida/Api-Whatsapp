<?php

namespace App\Core\Excecoes\Recursos;

use App\Core\Excecoes\Excecao;

class MensagemExcecao extends Excecao
{
    const NAME  = 'mensagem';

    public static function naoEncontrado() {
        return new static(self::NAME, '101');
    }
}
