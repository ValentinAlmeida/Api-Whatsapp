<?php

namespace App\Core\Excecoes\Contratos;

interface Enumeracao
{
    public function mensagem(): string;

    public function codigo(): string;
}
