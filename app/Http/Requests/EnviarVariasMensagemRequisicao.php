<?php

namespace App\Http\Requests;

use App\Core\DTO\EnviarMensagemDTO as CadastrarDTO;

class EnviarVariasMensagemRequisicao extends ApiRequisicao
{
    public function rules()
    {
        return [
            '*.nome' => 'required|string',
            '*.cnpj' => 'required|string',
            '*.telefone' => 'required|integer',
        ];
    }

    public function getData(): array
    {
        return array_map(function ($item) {
            return new CadastrarDTO(
                $item['telefone'],
                $item['nome'],
                $item['cnpj']
            );
        }, $this->all());
    }
}
