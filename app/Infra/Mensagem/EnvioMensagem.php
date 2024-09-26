<?php

namespace App\Infra\Mensagem;

use App\Core\Contratos\Servicos\ContaService;
use App\Core\Contratos\Servicos\LogService;
use App\Core\DTO\CadastrarLogDTO;
use App\Core\DTO\EnviarMensagemDTO;
use App\Core\Entidades\Conta;
use App\Core\Filtros\ContaFiltros;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;

class EnvioMensagem
{
    public function enviarMensagem(EnviarMensagemDTO $dados, Conta $conta): array
    {
        $url = 'https://graph.facebook.com/' . env('VERSION') . '/' .  $conta->getWaId() .'/messages';

        $response = Http::withToken($conta->getToken())->post($url, [
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

        $this->criarLog($response->json(), $conta);

        return $response->json();
    }
    public function enviarMensagemTemplate1(EnviarMensagemDTO $dados, Conta $conta): array
    {
        $url = 'https://graph.facebook.com/' . env('VERSION') . '/' .  $conta->getWaId() .'/messages';
    
        $response = Http::withToken($conta->getToken())->post($url, [
            'messaging_product' => 'whatsapp',
            'to' => $dados->telefone,
            'type' => 'template',
            'template' => [
                'name' => 'identite_template_1',
                'language' => [
                    'code' => 'pt_BR'
                ]
            ]
        ]);

        $this->criarLog($response->json(), $conta);
    
        return $response->json();
    }
    
    public function enviarVariasMensagens(array $mensagens, int $template_id): void
    {
        $contas = $this->buscarContas();
        $totalMensagens = count($mensagens);
        $distribuicao = $this->distribuirMensagens($contas, $totalMensagens);

        $indiceMensagem = 0;

        foreach ($contas as $indexConta => $conta) {
            $quantidadeMensagensParaConta = $distribuicao[$indexConta];
            
            $indiceMensagem = $this->enviarMensagensParaConta($mensagens, $conta, $indiceMensagem, $quantidadeMensagensParaConta, $template_id);
        }
    }

    private function buscarContas(): array
    {
        $contaService = App::make(ContaService::class);
        return $contaService->buscar(new ContaFiltros());
    }

    private function distribuirMensagens(array $contas, int $totalMensagens): array
    {
        $totalContas = count($contas);
        $mensagensPorConta = intdiv($totalMensagens, $totalContas);
        $mensagensRestantes = $totalMensagens % $totalContas;

        $distribuicao = array_fill(0, $totalContas, $mensagensPorConta);

        for ($i = 0; $i < $mensagensRestantes; $i++) {
            $distribuicao[$i]++;
        }

        return $distribuicao;
    }

    private function enviarMensagensParaConta(array $mensagens, $conta, int $indiceMensagem, int $quantidadeMensagensParaConta, int $template_id): int
    {
        for ($i = 0; $i < $quantidadeMensagensParaConta; $i++) {
            if (isset($mensagens[$indiceMensagem])) {
                $mensagem = $mensagens[$indiceMensagem];

                if($template_id == 1)
                {
                    Queue::push(function() use ($mensagem, $conta) {
                        $this->enviarMensagem($mensagem, $conta);
                    });
                }

                if($template_id == 2)
                {
                    Queue::push(function() use ($mensagem, $conta) {
                        $this->enviarMensagemTemplate1($mensagem, $conta);
                    });
                }
                
                $indiceMensagem++;
            }
        }

        return $indiceMensagem;
    }

    private function criarLog(array $mensagens, Conta $conta): void
    {
        if (array_key_exists('error', $mensagens)) {
            $error = $mensagens['error'];
            
            if (array_key_exists('message', $error)) {
                $logDTO = new CadastrarLogDTO(
                    $error['message'],
                    (int)$conta->getIdentificador()->valor()
                );
    
                $logService = App::make(LogService::class);
                $logService->cadastrar($logDTO);
            }
        }
    }
}
