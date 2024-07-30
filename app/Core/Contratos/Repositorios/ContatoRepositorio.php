<?php

namespace App\Core\Contratos\Repositorios;

use App\Core\DTO\CadastrarContatoDTO as CadastrarDTO;
use App\Core\Entidades\Contato as Entidade;

interface ContatoRepositorio
{
    public function criar(CadastrarDTO $dados): Entidade;
}
