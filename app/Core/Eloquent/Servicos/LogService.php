<?php

namespace App\Core\Eloquent\Servicos;

use App\Core\Contratos\Servicos\LogService as Contrato;
use App\Core\Contratos\Repositorios\LogRepositorio as Repositorio;
use App\Core\DTO\CadastrarLogDTO as CadastrarDTO;
use App\Core\Entidades\Log as Entidade;
use App\Core\Filtros\LogFiltro as Filtro;
use App\Core\Helpers\LogHelper as Helper;

class LogService implements Contrato
{

    public function __construct(
        private readonly Repositorio $repositorio
    )
    {
    }

    public function cadastrar(CadastrarDTO $dados): Entidade
    {
        $entidade = Entidade::create($dados);

        $log = $this->repositorio->criar(dados: $entidade);

        return Helper::adicionarConta($log);
    }

    public function buscar(Filtro $dados): array
    {
        $entidades = $this->repositorio->buscar($dados);
        
        return array_map(function (Entidade $entidade): Entidade {
            return Helper::adicionarConta($entidade);
        }, $entidades);
    }
}
