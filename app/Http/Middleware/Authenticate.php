<?php

namespace App\Http\Middleware;

use App\Core\Excecoes\AutenticacaoError;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Core\Contratos\Servicos\AutenticacaoService;

class Authenticate extends Middleware
{
    public function __construct(
        private readonly AutenticacaoService $autenticacaoService,
    ) {
    }

    protected function authenticate($request, array $guards)
    {
        $token = $request->headers->get('authorization');

        if(is_null($token)) {
            $token = $request->query('token');
        }

        if (!$token) {
            throw AutenticacaoError::tokenNaoEncontrado();
        }

        $this->autenticacaoService->validarToken($token);

        return next($request);
    }
}
