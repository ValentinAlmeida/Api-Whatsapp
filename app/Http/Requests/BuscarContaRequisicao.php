<?php

namespace App\Http\Requests;

use App\Core\Filtros\ContaFiltros as Filtro;

class BuscarContaRequisicao extends ApiRequisicao
{
    public function rules()
    {
        return [
            "wa_id", "token" => 'sometimes|string'
        ];
    }

    public function getData(): Filtro
    {
        $filtro = new Filtro();
        
        $filtro->waId = $this->input("wa_id");
        $filtro->token = $this->input("token");

        return $filtro;
    }
}
