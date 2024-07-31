<?php

namespace App\Core\Eloquent\Repositorios;

use App\Core\Contratos\Repositorios\MensagemRepositorio as Contrato;
use App\Core\Contratos\Servicos\ContatoService;
use App\Core\DTO\CadastrarMensagemDTO as CadastrarDTO;
use App\Core\Entidades\Mensagem as Entidade;
use App\Core\Excecoes\Recursos\MensagemExcecao as Excecao;
use App\Models\Mensagem as Model;
use Illuminate\Support\Facades\App;

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

    public function encontrarPorId(int $id): Entidade
    {
        /** @var Model */
        $entidade = Model::find($id);

        throw_if(!$entidade, Excecao::naoEncontrado());

        $contatoService = App::make(ContatoService::class);
        $contato = $contatoService->encontrarPorId($entidade->contato_id);

        return Entidade::build(
            $entidade->id,
            $entidade->telefone,
            $entidade->mensagem,
            $entidade->tipo,
            $contato ?? null,
            $entidade->created_at,
            $entidade->data_envio,
        );
    }
}
