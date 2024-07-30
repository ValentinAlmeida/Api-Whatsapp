<?php

namespace App\Core\Contratos\Repositorios;

use App\Core\DTO\CadastrarContatoDTO as CadastrarDTO;
use App\Core\Entidades\Contato as Entidade;
use App\Core\Filtros\ContatoFiltro as Filtro;

interface ContatoRepositorio
{
    public function criar(CadastrarDTO $dados): Entidade;

    public function buscar(Filtro $filtro): array;
}
