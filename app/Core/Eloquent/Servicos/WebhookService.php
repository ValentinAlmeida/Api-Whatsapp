<?php

namespace App\Core\Eloquent\Servicos;

use App\Core\Contratos\Servicos\WebhookService as Contrato;
use App\Core\Contratos\Repositorios\WebhookRepositorio as Repositorio;
use App\Core\Contratos\Servicos\ContatoService;
use App\Core\Contratos\Servicos\MensagemService;
use App\Core\DTO\CadastrarContatoDTO;
use App\Core\DTO\CadastrarMensagemDTO;
use App\Core\DTO\CadastrarWebhookDTO as CadastrarDTO;
use App\Core\Negocios\Webhook as Negocio;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class WebhookService implements Contrato
{

    public function __construct(
        private readonly Repositorio $repositorio
    )
    {
    }

    public function cadastrar(CadastrarDTO $dados, CadastrarContatoDTO $contatoDTO, CadastrarMensagemDTO $mensagemDTO): Negocio
    {
        $entidade = $this->repositorio->criar($dados);

        if($contatoDTO->telefone){
            $contatoService = App::make(ContatoService::class);
            $contato = $contatoService->cadastrar($contatoDTO);
        }

        if($mensagemDTO->mensagem){
            $mensagemService = App::make(MensagemService::class);
            $mensagemService->cadastrar($mensagemDTO, $contato->id);
        }

        return new Negocio(
            intval($entidade->getIdentificador()->valor()),
            $entidade->webhook(),
            $entidade->type(),
            Carbon::create($entidade->dataRecuperacao()),
            $entidade->hubChallenge(),
        );
    }
}
