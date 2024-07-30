<?php

namespace App\Http\Controllers;

use App\Core\Contratos\Servicos\AutenticacaoService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\AutenticarRequisicao;
use Illuminate\Support\Facades\App;

class AutenticacaoController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function autenticar(AutenticarRequisicao $request)
    {
        $autenticacaoService = App::make(AutenticacaoService::class);
        return $autenticacaoService->autenticar($request->getCredencial());
    }
}
