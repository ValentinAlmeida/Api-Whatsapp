<?php

namespace App\Support\Serializers;

use App\Core\Negocios\Contato;
use App\Core\Negocios\Mensagem;
use App\Core\Negocios\Webhook;

class WebhookSerializer
{
    public static function parseEntidade(Webhook $entidade, Contato $contato, Mensagem $mensagem)
    {
        return [
            'id' => $entidade->id,
            'webhook' => $entidade->webhook,
            'type' => $entidade->type,
            'data_cadastro' => $entidade->data_cadastro,
            'contato' => $contato,
            'hub_challenge' => $entidade->hub_challenge,
            'mensagem' => $mensagem,
        ];
    }
}
