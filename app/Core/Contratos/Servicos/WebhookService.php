<?php

namespace App\Core\Contratos\Servicos;

use App\Core\DTO\CadastrarWebhookDTO as CadastrarDTO;
use App\Core\Negocios\Webhook as Negocio;

interface WebhookService
{
    public function cadastrar(CadastrarDTO $dados): Negocio;
}
