<?php

namespace App\Http\Requests;

use App\Core\DTO\EnviarMensagemDTO as CadastrarDTO;

class EnviarMensagemRequisicao extends ApiRequisicao
{
    public function rules()
    {
        return [
            'nome', 'cnpj' => 'required|string',
            'telefone' => 'required|integer',
            'conta_id' => 'sometimes|integer|exists:conta,id',
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

    public function getConta(): int
    {
        return $this->input('conta_id');
    }
}
