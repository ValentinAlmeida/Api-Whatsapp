<?php

namespace App\Core\Contratos\Servicos;

use App\Core\DTO\CadastrarContaDTO as CadastrarDTO;
use App\Core\DTO\EditarContaDTO as EditarDTO;
use App\Core\Entidades\Conta as Entidade;
use App\Core\Filtros\ContaFiltros as Filtro;

interface ContaService
{
    public function cadastrar(CadastrarDTO $dados): Entidade;

    public function encontrarPorId(int $id): Entidade;
    
    public function buscar(Filtro $dados): array;

    public function editar(int $id, EditarDTO $dados): void;
    
    public function deletar(int $id): void;
}
