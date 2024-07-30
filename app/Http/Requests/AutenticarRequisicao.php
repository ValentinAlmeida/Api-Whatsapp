<?php

namespace App\Http\Requests;

use App\Core\VO\Credencial;

class AutenticarRequisicao extends ApiRequisicao
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email" => 'required|string',
            "senha" => 'required|string',
        ];
    }

    public function getCredencial()
    {
        return Credencial::create(
            $this->post('email'),
            $this->post('senha')
        );
    }
}
