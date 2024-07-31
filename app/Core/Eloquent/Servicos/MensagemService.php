<?php

namespace App\Core\Eloquent\Servicos;

use App\Core\Contratos\Servicos\MensagemService as Contrato;
use App\Core\Contratos\Repositorios\MensagemRepositorio as Repositorio;
use App\Core\DTO\CadastrarMensagemDTO as CadastrarDTO;
use App\Core\Entidades\Mensagem as Entidade;
use App\Core\Filtros\MensagemFiltros as Filtro;
use App\Core\Negocios\Mensagem as Negocio;
use Carbon\Carbon;

class MensagemService implements Contrato
{

    public function __construct(
        private readonly Repositorio $repositorio
    )
    {
    }

    public function cadastrar(CadastrarDTO $dados, int $contatoId): Negocio
    {
        $entidade = $this->repositorio->criar($dados, $contatoId);

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

    public function encontrarPorId(int $id): Negocio
    {
        $entidade = $this->repositorio->encontrarPorId($id);

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

    public function buscar(Filtro $dados): array
    {
        $entidades = $this->repositorio->buscar($dados);

        return array_map(fn(Entidade $entidade) => new Negocio(
            intval($entidade->getIdentificador()->valor()),
            $entidade->telefone(),
            $entidade->mensagem(),
            $entidade->tipo(),
            $entidade->contato(),
            Carbon::create($entidade->dataRecuperacao()),
            Carbon::create($entidade->dataEnvio())
        ), $entidades);
    }
}
