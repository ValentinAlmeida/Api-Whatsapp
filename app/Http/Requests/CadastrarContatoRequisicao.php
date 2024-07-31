<?php

namespace App\Http\Requests;

use App\Core\DTO\CadastrarContatoDTO as CadastrarDTO;

class CadastrarContatoRequisicao extends ApiRequisicao
{
    public function rules()
    {
        return [
            "nome" => 'required|string',
            "telefone" => 'required|integer'
        ];
    }

    public function getDataContact(): CadastrarDTO
    {
        return new CadastrarDTO(
            $this->input("nome"),
            $this->input("telefone"),
        );
    }
}
