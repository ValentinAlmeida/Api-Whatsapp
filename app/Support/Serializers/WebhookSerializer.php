<?php

namespace App\Support\Serializers;

use App\Core\Negocios\Webhook;

class WebhookSerializer
{
    public static function parseEntidade(Webhook $entidade)
    {
        return [
            'id' => $entidade->id,
            'webhook' => $entidade->webhook,
            'type' => $entidade->type,
            'data_cadastro' => $entidade->data_cadastro,
        ];
    }
}
