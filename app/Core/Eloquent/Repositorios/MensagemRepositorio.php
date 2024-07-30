<?php

namespace App\Core\Eloquent\Repositorios;

use App\Core\Contratos\Repositorios\MensagemRepositorio as Contrato;
use App\Core\Contratos\Servicos\ContatoService;
use App\Core\DTO\CadastrarMensagemDTO as CadastrarDTO;
use App\Core\Entidades\Mensagem as Entidade;
use App\Core\Filtros\ContatoFiltros;
use App\Models\Mensagem as Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class MensagemRepositorio implements Contrato
{
    public function criar(CadastrarDTO $dados): Entidade
    {
        $entidade = Model::create([
            Model::TELEFONE => $dados->telefone,
            Model::MENSAGEM => $dados->mensagem,
            Model::TIPO => $dados->tipo,
            Model::DATA_ENVIO => $dados->data_envio,
        ]);

        return Entidade::build(
            $entidade->id,
            $entidade->telefone,
            $entidade->mensagem,
            $entidade->tipo,
            null,
            $entidade->created_at,
            $entidade->data_envio,
        );
    }
}
