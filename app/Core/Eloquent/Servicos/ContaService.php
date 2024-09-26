<?php

namespace App\Core\Eloquent\Servicos;

use App\Core\Contratos\Servicos\ContaService as Contrato;
use App\Core\Contratos\Repositorios\ContaRepositorio as Repositorio;
use App\Core\DTO\CadastrarContaDTO as CadastrarDTO;
use App\Core\DTO\EditarContaDTO;
use App\Core\Entidades\Conta as Entidade;
use App\Core\Filtros\ContaFiltros as Filtro;

class ContaService implements Contrato
{

    public function __construct(
        private readonly Repositorio $repositorio
    )
    {
    }

    public function cadastrar(CadastrarDTO $dados): Entidade
    {
        $entidade = Entidade::create($dados);

        return $this->repositorio->criar($entidade);
    }

    public function encontrarPorId(int $id): Entidade
    {
        return $this->repositorio->encontrarPorId($id);
    }

    public function buscar(Filtro $dados): array
    {
        $entidades = $this->repositorio->buscar($dados);
        
        return array_map(function(Entidade $entidade): Entidade{
            return $entidade;
        }, $entidades);
    }

    public function editar(int $id, EditarContaDTO $dados): void
    {
        $entidade = $this->encontrarPorId($id);

        $cadastrarDTO = new CadastrarDTO(
            $dados->token ?? $entidade->getToken(),
            $dados->wa_id ?? $entidade->getWaId(),
            $dados->nome ?? $entidade->getNome(),
        );

        $nova_entidade = Entidade::create($cadastrarDTO);

        $this->repositorio->editar((int)$entidade->getIdentificador()->valor(), $nova_entidade);
    }

    public function deletar(int $id): void
    {
        $this->repositorio->deletar($id);
    }
}
