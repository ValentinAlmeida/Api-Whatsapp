<?php

namespace App\Core\Contratos\Repositorios;

use App\Core\DTO\EditarContaDTO as EditarDTO;
use App\Core\Entidades\Conta as Entidade;
use App\Core\Filtros\ContaFiltros as Filtro;

interface ContaRepositorio
{
    public function criar(Entidade $dados): Entidade;

    public function encontrarPorId(int $id): Entidade;

    public function buscar(Filtro $dados): array;

    public function editar(int $id, Entidade $dados): void;
    
    public function deletar(int $id): void;
}
