<?php

namespace App\Core\Excecoes\Recursos;

use App\Core\Excecoes\Excecao;

class UsuarioExcecao extends Excecao
{
    const NAME  = 'usuario';

    public static function naoEncontrado() {
        return new static(self::NAME, '101');
    }

    public static function jaExiste(?string $campo = null) {
        return new static(self::NAME, '102', $campo);
    }

    public static function estaInativo() {
        return new static(self::NAME, '104', null, 'Usuário está inativo');
    }
}
