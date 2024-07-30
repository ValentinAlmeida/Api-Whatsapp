<?php

namespace App\Http\Requests;

use App\Core\DTO\CadastrarWebhookDTO as CadastrarDTO;

class CadastrarWebhookRequisicao extends ApiRequisicao
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
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
}
