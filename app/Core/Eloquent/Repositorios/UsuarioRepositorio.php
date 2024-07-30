<?php

namespace App\Core\Eloquent\Repositorios;

use App\Core\Contratos\Repositorios\UsuarioRepositorio as Contrato;
use App\Core\Entidades\Usuario;
use App\Models\Usuario as ModelsUsuario;

class UsuarioRepositorio implements Contrato
{
    public function encontrarByEmail(string $email): ?Usuario
    {
        $model = ModelsUsuario::where('email', $email)->first();

        return $model ? Usuario::build(
            $model->id,
            $model->nome,
            $model->email,
            $model->senha,
        ) : null;
    }
}
