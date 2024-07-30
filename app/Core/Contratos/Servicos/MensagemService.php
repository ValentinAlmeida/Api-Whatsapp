<?php

namespace App\Core\Contratos\Servicos;

use App\Core\DTO\CadastrarMensagemDTO as CadastrarDTO;
use App\Core\Negocios\Mensagem as Negocio;

interface MensagemService
{
    public function cadastrar(CadastrarDTO $dados): Negocio;
}
