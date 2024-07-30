<?php

namespace App\Http\Requests;

use App\Core\DTO\CadastrarContatoDTO;
use App\Core\DTO\CadastrarWebhookDTO as CadastrarDTO;

class CadastrarWebhookRequisicao extends ApiRequisicao
{
    public function rules()
    {
        return [
            "webhook" => 'sometimes|string'
        ];
    }

    public function getData(): CadastrarDTO
    {
        return new CadastrarDTO(
            json_encode($this->all()),
            $this->getMethod()
        );
    }

    public function getDataContact(): CadastrarContatoDTO
    {
        $data = $this->all();

        $nome = $data['entry'][0]['changes'][0]['value']['contacts'][0]['profile']['name'] ?? null;
        $waId = $data['entry'][0]['changes'][0]['value']['contacts'][0]['wa_id'] ?? null;

        return new CadastrarContatoDTO(
            $nome,
            $waId
        );
    }
}
