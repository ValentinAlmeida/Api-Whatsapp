<?php

namespace App\Core\Eloquent\Repositorios;

use App\Core\Contratos\Repositorios\MensagemRepositorio as Contrato;
use App\Core\Contratos\Servicos\ContatoService;
use App\Core\DTO\CadastrarMensagemDTO as CadastrarDTO;
use App\Core\Entidades\Mensagem as Entidade;
use App\Core\Excecoes\Recursos\MensagemExcecao as Excecao;
use App\Core\Filtros\ContatoFiltros;
use App\Core\Filtros\MensagemFiltros as Filtro;
use App\Models\Mensagem as Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class MensagemRepositorio implements Contrato
{
    public function criar(CadastrarDTO $dados, int $contatoId): Entidade
    {
        $entidade = Model::create([
            Model::TELEFONE => $dados->telefone,
            Model::MENSAGEM => $dados->mensagem,
            Model::TIPO => $dados->tipo,
            Model::CONTATO_ID => $contatoId,
            Model::DATA_ENVIO => $dados->data_envio,
        ]);

        $contatoService = App::make(ContatoService::class);
        $contato = $contatoService->encontrarPorId($entidade->contato_id);

        return Entidade::build(
            $entidade->id,
            $entidade->telefone,
            $entidade->mensagem,
            $entidade->tipo,
            $contato,
            Carbon::create($entidade->created_at),
            Carbon::create($entidade->data_envio),
        );
    }

    public function buscar(Filtro $filtro): array
    {
        $query = Model::query();
        $contatoService = App::make(ContatoService::class);

        if (!empty($filtro->nome)) {
            $filtroDTO = new ContatoFiltros();
            $filtroDTO->nome = $filtro->nome;

            $contato = $contatoService->buscar($filtroDTO);

            if($contato){
                array_map(function ($entidade) use ($query) {
                    $query->where('contato_id', $entidade->id);
                }, $contato);
            }else{
                return [];
            }
        }

        if (!empty($filtro->telefone)) {
            $query->where('telefone', $filtro->telefone);
        }

        if (!empty($filtro->mensagem)) {
            $query->where('mensagem', $filtro->mensagem);
        }

        if (!empty($filtro->contato_id)) {
            $query->where('contato_id', $filtro->contato_id);
        }

        if (!empty($filtro->data_envio)) {
            $query->where(Model::DATA_ENVIO, '>=', $filtro->data_envio);
        }

        $entidades = $query->get();

        return $entidades->map(function ($entidade) use ($contatoService) {
            $contato = $contatoService->encontrarPorId($entidade->contato_id);
            
            return Entidade::build(
                $entidade->id,
                $entidade->telefone,
                $entidade->mensagem,
                $entidade->tipo,
                $contato ?? null,
                Carbon::create($entidade->created_at),
                Carbon::create($entidade->data_envio),
            );
        })->toArray();
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
            Carbon::create($entidade->created_at),
            Carbon::create($entidade->data_envio),
        );
    }
}
