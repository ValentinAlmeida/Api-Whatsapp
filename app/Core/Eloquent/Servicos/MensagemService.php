<?php

namespace App\Core\Eloquent\Servicos;

use App\Core\Contratos\Servicos\MensagemService as Contrato;
use App\Core\Contratos\Repositorios\MensagemRepositorio as Repositorio;
use App\Core\DTO\CadastrarMensagemDTO as CadastrarDTO;
use App\Core\Negocios\Mensagem as Negocio;
use Carbon\Carbon;

class MensagemService implements Contrato
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
            $entidade->telefone(),
            $entidade->mensagem(),
            $entidade->tipo(),
            $entidade->contato(),
            Carbon::create($entidade->dataRecuperacao()),
            Carbon::create($entidade->dataEnvio())
        );
    }
}
