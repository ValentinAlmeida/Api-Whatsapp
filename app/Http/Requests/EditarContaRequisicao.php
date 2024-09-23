<?php

namespace App\Http\Requests;

use App\Core\DTO\EditarContaDTO as EditarDTO;

class EditarContaRequisicao extends ApiRequisicao
{
    public function rules()
    {
        return [
            "wa_id", "token" => 'sometimes|string',
        ];
    }

    public function getData(): EditarDTO
    {
        return new EditarDTO(
            $this->input("wa_id"),
            $this->input("token"),
        );
    }
}
