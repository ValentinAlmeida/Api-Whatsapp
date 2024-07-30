<?php

namespace App\Core\Eloquent\Servicos;

use App\Core\Contratos\Servicos\WebhookService as Contrato;
use App\Core\Contratos\Repositorios\WebhookRepositorio as Repositorio;
use App\Core\DTO\CadastrarWebhookDTO as CadastrarDTO;
use App\Core\Negocios\Webhook as Negocio;
use Carbon\Carbon;

class WebhookService implements Contrato
{

    public function __construct(
        private readonly Repositorio $repositorio
    )
    {
    }

    public function cadastrar(CadastrarDTO $dados): Negocio
    {
        $entidade = $this->repositorio->criar($dados);

        return new Negocio(
            intval($entidade->getIdentificador()->valor()),
            $entidade->webhook(),
            $entidade->type(),
            Carbon::create($entidade->dataRecuperacao())
        );
    }
}
