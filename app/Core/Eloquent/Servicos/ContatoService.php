<?php

namespace App\Core\Eloquent\Servicos;

use App\Core\Contratos\Servicos\ContatoService as Contrato;
use App\Core\Contratos\Repositorios\ContatoRepositorio as Repositorio;
use App\Core\DTO\CadastrarContatoDTO as CadastrarDTO;
use App\Core\Entidades\Contato as Entidade;
use App\Core\Filtros\ContatoFiltros as Filtro;
use App\Core\Negocios\Contato as Negocio;
use Carbon\Carbon;

class ContatoService implements Contrato
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
            $entidade->nome(),
            $entidade->telefone(),
            Carbon::create($entidade->dataRecuperacao())
        );
    }

    public function buscar(Filtro $dados): array
    {
        $entidades = $this->repositorio->buscar($dados);

        return array_map(fn(Entidade $entidade) => new Negocio(
            intval($entidade->getIdentificador()->valor()),
            $entidade->nome(),
            $entidade->telefone(),
            Carbon::create($entidade->dataRecuperacao())
        ), $entidades);
    }

    public function encontrarPorId(int $id): Negocio
    {
        $entidade = $this->repositorio->encontrarPorId($id);

        return new Negocio(
            intval($entidade->getIdentificador()->valor()),
            $entidade->nome(),
            $entidade->telefone(),
            Carbon::create($entidade->dataRecuperacao())
        );
    }
}
