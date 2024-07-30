<?php

namespace App\Core\Contratos;

use App\Core\VO\Identificador;

interface Autenticavel
{
   public function email(): string;
   public function nome(): string;
}
