<?php

namespace App\Core\Contratos\Repositorios;

use App\Core\DTO\CadastrarWebhookDTO as CadastrarDTO;
use App\Core\Entidades\Webhook as Entidade;

interface WebhookRepositorio
{
    public function criar(CadastrarDTO $dados): Entidade;
}
