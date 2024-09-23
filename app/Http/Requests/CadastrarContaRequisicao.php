<?php

namespace App\Http\Requests;

use App\Core\DTO\CadastrarContaDTO as CadastrarDTO;

class CadastrarContaRequisicao extends ApiRequisicao
{
    public function rules()
    {
        return [
            "wa_id", "token", "nome" => 'required|string',
        ];
    }

    public function getData(): CadastrarDTO
    {
        return new CadastrarDTO(
            $this->input("token"),
            $this->input("wa_id"),
            $this->input("nome"),
        );
    }
}
