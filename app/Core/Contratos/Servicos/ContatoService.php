<?php

namespace App\Core\Contratos\Servicos;

use App\Core\DTO\CadastrarContatoDTO as CadastrarDTO;
use App\Core\Filtros\ContatoFiltro as Filtro;
use App\Core\Negocios\Contato as Negocio;

interface ContatoService
{
    public function cadastrar(CadastrarDTO $dados): Negocio;

    public function buscar(Filtro $dados): array;
}
