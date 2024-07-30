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
            "webhook" => 'sometimes|string',
            "type" => 'sometimes|string',
        ];
    }

    public function getData(): CadastrarDTO
    {
        return new CadastrarDTO(
            $this->input('webhook'),
            $this->input('type')
        );
    }
}
