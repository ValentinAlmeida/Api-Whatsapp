<?php

namespace App\Core\Contratos\Repositorios;

use App\Core\DTO\CadastrarMensagemDTO as CadastrarDTO;
use App\Core\Entidades\Mensagem as Entidade;

interface MensagemRepositorio
{
    public function criar(CadastrarDTO $dados, int $contatoId): Entidade;

    public function encontrarPorId(int $id): Entidade;
}
