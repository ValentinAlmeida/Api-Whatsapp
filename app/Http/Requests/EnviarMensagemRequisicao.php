<?php

namespace App\Http\Requests;

use App\Core\DTO\EnviarMensagemDTO as CadastrarDTO;

class EnviarMensagemRequisicao extends ApiRequisicao
{
    public function rules()
    {
        return [
            "nome" => 'required|string',
            "cnpj" => 'required|string',
            "telefone" => 'required|integer',
        ];
    }

    public function getData(): CadastrarDTO
    {
        return new CadastrarDTO(
            $this->input('telefone'),
            $this->input('nome'),
            $this->input('cnpj')
        );
    }
}
