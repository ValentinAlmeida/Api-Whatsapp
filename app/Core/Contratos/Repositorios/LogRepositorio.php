<?php

namespace App\Core\Contratos\Repositorios;

use App\Core\Entidades\Log as Entidade;
use App\Core\Filtros\LogFiltro as Filtro;

interface LogRepositorio
{
    public function criar(Entidade $dados): Entidade;

    public function buscar(Filtro $dados): array;
}
