<?php

namespace App\Http\Requests;

use App\Constantes\Format;
use App\Core\Filtros\MensagemFiltros as Filtro;
use Carbon\Carbon;

class BuscarMensagemRequisicao extends ApiRequisicao
{
    public function rules()
    {
        return [
            "nome", "mensagem" => 'sometimes|string',
            "telefone", "contato_id" => 'sometimes|integer',
            "data_envio" => ['sometimes', 'date_format:' . Format::DATE_TIME],
        ];
    }

    public function getData(): Filtro
    {
        $filtro = new Filtro();
        
        $filtro->nome = $this->input("nome");
        $filtro->mensagem = $this->input("mensagem");
        $filtro->telefone = $this->input("telefone");
        $filtro->contato_id = $this->input("contato_id");

        if ($this->has('data_envio')) {
            $filtro->data_envio = Carbon::createFromFormat(Format::DATE_TIME, $this->query('data_envio'));
        }

        return $filtro;
    }
}
