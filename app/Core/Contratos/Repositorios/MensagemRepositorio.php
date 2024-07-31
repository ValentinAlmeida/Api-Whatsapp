<?php

namespace App\Core\Contratos\Repositorios;

use App\Core\DTO\CadastrarMensagemDTO as CadastrarDTO;
use App\Core\Entidades\Mensagem as Entidade;
use App\Core\Filtros\MensagemFiltros as Filtro;

interface MensagemRepositorio
{
    public function criar(CadastrarDTO $dados, int $contatoId): Entidade;

    public function encontrarPorId(int $id): Entidade;

    public function buscar(Filtro $dados): array;
}
