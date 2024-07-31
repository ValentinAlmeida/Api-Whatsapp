<?php

namespace App\Http\Requests;

use App\Constantes\Format;
use App\Core\DTO\CadastrarMensagemDTO as CadastrarDTO;

class CadastrarMensagemRequisicao extends ApiRequisicao
{
    public function rules()
    {
        return [
            "mensagem", "tipo" => 'required|string',
            "telefone", "contato_id" => 'required|integer',
            "data_envio" => ['sometimes', 'date_format:' . Format::DATE_TIME],
        ];
    }

    public function getData(): CadastrarDTO
    {
        return new CadastrarDTO(
            $this->input("telefone"),
            $this->input("mensagem"),
            $this->input("tipo"),
            $this->input("data_envio"),
            $this->input("contato_id"),
        );
    }
}
