<?php

namespace App\Core\Eloquent\Servicos;

use App\Core\Contratos\Servicos\ContaService as Contrato;
use App\Core\Contratos\Repositorios\ContaRepositorio as Repositorio;
use App\Core\DTO\CadastrarContaDTO as CadastrarDTO;
use App\Core\DTO\EditarContaDTO;
use App\Core\Entidades\Conta as Entidade;
use App\Core\Filtros\ContaFiltros as Filtro;
use App\Core\Negocios\Conta as Negocio;

class ContaService implements Contrato
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
            $entidade->token(),
            $entidade->wa_id(),
        );
    }

    public function encontrarPorId(int $id): Negocio
    {
        $entidade = $this->repositorio->encontrarPorId($id);

        return new Negocio(
            intval($entidade->getIdentificador()->valor()),
            $entidade->token(),
            $entidade->wa_id(),
        );
    }

    public function buscar(Filtro $dados): array
    {
        $entidades = $this->repositorio->buscar($dados);
        
        return array_map(fn(Entidade $entidade) => new Negocio(
            intval($entidade->getIdentificador()->valor()),
            $entidade->token(),
            $entidade->wa_id(),
        ), $entidades);
    }

    public function editar(int $id, EditarContaDTO $dados): void
    {
        $this->repositorio->editar($id, $dados);
    }
}
