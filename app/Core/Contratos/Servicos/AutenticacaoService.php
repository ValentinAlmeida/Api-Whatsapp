<?php

namespace App\Core\Contratos\Servicos;

use App\Core\Contratos\Token;
use App\Core\VO\Credencial;
use Illuminate\Http\Response;

interface AutenticacaoService
{
    public function autenticar(Credencial $credencial): Response;

    public function validarToken(string $token): Token;
}
