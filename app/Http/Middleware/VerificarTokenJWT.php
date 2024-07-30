<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Core\Excecoes\AutenticacaoError;
use App\Core\Contratos\Servicos\AutenticacaoService;
use Illuminate\Support\Facades\Cache;

class VerificarTokenJWT
{
    public function __construct(private AutenticacaoService $autenticacaoService)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (is_null($token)) {
            $token = $request->query('token');
        }

        if (!$token) {
            throw AutenticacaoError::tokenNaoEncontrado();
        }

        $user = $this->autenticacaoService->getAutenticavelPorToken($token);

        Cache::put('user', $user);

        return $next($request);
    }
}
