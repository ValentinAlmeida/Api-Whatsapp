<?php

namespace App\Http\Requests;

use App\Core\Filtros\ContatoFiltros as Filtro;

class BuscarContatoRequisicao extends ApiRequisicao
{
    public function rules()
    {
        return [
            "nome" => 'sometimes|string',
            "telefone", "id" => 'sometimes|integer'
        ];
    }

    public function getData(): Filtro
    {
        $filtro = new Filtro();
        
        $filtro->nome = $this->input("nome");
        $filtro->telefone = $this->input("telefone");
        $filtro->id = $this->input("id");

        return $filtro;
    }
}
