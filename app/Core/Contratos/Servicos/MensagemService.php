<?php

namespace App\Core\Contratos\Servicos;

use App\Core\DTO\CadastrarMensagemDTO as CadastrarDTO;
use App\Core\Filtros\MensagemFiltros as Filtro;
use App\Core\Negocios\Mensagem as Negocio;

interface MensagemService
{
    public function cadastrar(CadastrarDTO $dados, int $contatoId): Negocio;

    public function encontrarPorId(int $id): Negocio;
    
    public function buscar(Filtro $dados): array;
}
