<?php

namespace App\Http\Requests;

use App\Core\Contratos\Servicos\ContatoService;
use App\Core\DTO\CadastrarContatoDTO;
use App\Core\DTO\CadastrarMensagemDTO;
use App\Core\DTO\CadastrarWebhookDTO as CadastrarDTO;
use App\Core\Filtros\ContatoFiltros;
use Illuminate\Support\Facades\App;

class CadastrarWebhookRequisicao extends ApiRequisicao
{
    public function rules()
    {
        return [
            "webhook" => 'sometimes|string',
            "hub_challenge" => 'sometimes|string'
        ];
    }

    public function getData(): CadastrarDTO
    {
        return new CadastrarDTO(
            json_encode($this->all()),
            $this->getMethod(),
            $this->input("hub_challenge"),
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

    public function getDataMensage(): CadastrarMensagemDTO
    {
        $data = $this->all();
        $message = $data['entry'][0]['changes'][0]['value']['messages'][0] ?? null;
    
        if ($message) {
            $telefone = $message['from'] ?? null;
            $mensagem = $message['text']['body'] ?? null;
            $tipo = $message['type'] ?? null;
            $timestamp = $message['timestamp'] ?? null;
            $data_envio = $timestamp ? (new \DateTime())->setTimestamp((int)$timestamp) : null;
        } else {
            $telefone = $mensagem = $tipo = null;
            $data_envio = null;
        }
    
        return new CadastrarMensagemDTO(
            $telefone,
            $mensagem,
            $tipo,
            $data_envio
        );
    }
}
