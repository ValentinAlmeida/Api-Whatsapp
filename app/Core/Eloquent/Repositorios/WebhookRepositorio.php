<?php

namespace App\Core\Eloquent\Repositorios;

use App\Core\Contratos\Repositorios\WebhookRepositorio as Contrato;
use App\Core\DTO\CadastrarWebhookDTO as CadastrarDTO;
use App\Core\Entidades\Webhook as Entidade;
use App\Models\Webhook as Model;

class WebhookRepositorio implements Contrato
{
    public function criar(CadastrarDTO $dados): Entidade
    {
        $entidade = Model::create([
            Model::WEBHOOK => $dados->webhook,
            Model::TYPE => $dados->type,
            Model::HUB_CHALLENGE => $dados->hub_challenge,
        ]);

        return Entidade::build(
            $entidade->id,
            $entidade->webhook,
            $entidade->type,
            $entidade->created_at,
            $entidade->hub_challenge,
        );
    }
}
