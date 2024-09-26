<?php

namespace App\Http\Requests;

use App\Core\Filtros\LogFiltro as Filtro;

class BuscarLogRequisicao extends ApiRequisicao
{
    public function rules()
    {
        return [
            "conta_id" => 'sometimes|integer|exits:conta'
        ];
    }

    public function getData(): Filtro
    {
        $filtro = new Filtro();
        
        $filtro->conta_id = $this->input("conta_id");

        return $filtro;
    }
}
