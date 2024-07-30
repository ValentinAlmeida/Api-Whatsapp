<?php

namespace App\Core\Contratos\Repositorios;

use App\Core\Entidades\Usuario;

interface UsuarioRepositorio
{
    public function encontrarByEmail(string $email): ?Usuario;
}
