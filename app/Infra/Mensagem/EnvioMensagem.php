<?php

namespace App\Infra\Mensagem;

use App\Core\DTO\EnviarMensagemDTO;
use Illuminate\Support\Facades\Http;

class EnvioMensagem
{
    public function enviarMensagem(EnviarMensagemDTO $dados): array
    {
        $url = 'https://graph.facebook.com/' . env('VERSION') . '/363037383565948/messages';
    
        $response = Http::withToken(env('TOKEN'))->post($url, [
            'messaging_product' => 'whatsapp',
            'to' => $dados->telefone,
            'type' => 'template',
            'template' => [
                'name' => 'identite_template',
                'language' => [
                    'code' => 'pt_BR'
                ],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => $dados->nome
                            ],
                            [
                                'type' => 'text',
                                'text' => now()->format('d/m/Y')
                            ],
                            [
                                'type' => 'text',
                                'text' => $dados->cnpj
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    
        return $response->json();
    }

    public function enviarVariasMensagens(array $dados): array
    {
        $retorno = [];

        foreach($dados as $dado)
        {
            $retorno[] = $this->enviarMensagem($dado);
        }

        return $retorno;
    }
}