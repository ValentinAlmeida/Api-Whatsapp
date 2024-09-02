<?php

namespace App\Http\Requests;

use App\Core\DTO\EnviarMensagemDTO as CadastrarDTO;

class EnviarVariasMensagemRequisicao extends ApiRequisicao
{
    public function rules()
    {
        return [
        ];
    }

    public function getData(): array
    {
        return array_map(function ($item) {
            return new CadastrarDTO(
                $item['Telefone'] ?? null,
                $item['Nome\/Razão Social'] ?? $item['Razão Social'] ?? 'Prezado Cliente',
                $item['CPF\/CNPJ'] ?? 'Não encontrado'
            );
        }, $this->all());
    }
}
