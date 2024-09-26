<?php

namespace App\Core\Helpers;

use App\Core\Contratos\Servicos\ContaService;
use App\Core\Entidades\Log;
use Illuminate\Support\Facades\App;

class LogHelper
{
    public static function adicionarConta(Log $entidade): Log
    {
        $entidadeService = App::make(ContaService::class);
        $conta = $entidadeService->encontrarPorId($entidade->getContaRef());

        $entidade->setConta($conta);
        return $entidade;
    }
}
