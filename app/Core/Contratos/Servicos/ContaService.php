<?php

namespace App\Core\Contratos\Servicos;

use App\Core\DTO\CadastrarContaDTO as CadastrarDTO;
use App\Core\DTO\EditarContaDTO as EditarDTO;
use App\Core\Filtros\ContaFiltros as Filtro;
use App\Core\Negocios\Conta as Negocio;

interface ContaService
{
    public function cadastrar(CadastrarDTO $dados): Negocio;

    public function encontrarPorId(int $id): Negocio;
    
    public function buscar(Filtro $dados): array;

    public function editar(int $id, EditarDTO $dados): void;
}
