<?php

namespace App\Core\Contratos\Servicos;

use App\Core\DTO\CadastrarLogDTO as CadastrarDTO;
use App\Core\Entidades\Log as Entidade;
use App\Core\Filtros\LogFiltro as Filtro;

interface LogService
{
    public function cadastrar(CadastrarDTO $dados): Entidade;
    
    public function buscar(Filtro $dados): array;
}
