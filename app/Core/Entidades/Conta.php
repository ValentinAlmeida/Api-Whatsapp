<?php

namespace App\Core\Entidades;

use App\Core\DTO\CadastrarContaDTO;
use App\Core\DTO\RestaurarContaDTO;
use App\Core\Entidade;
use App\Core\Propriedade\ContaPropriedade;
use App\Core\VO\Identificador;

class Conta extends Entidade
{
    private ContaPropriedade $props;

    private function __construct(
    ContaPropriedade $props,
    ?Identificador $identificador = null
    )
    {
        parent::__construct(
            $identificador,
        );

        $this->props = $props;
    }

    public static function create(
        CadastrarContaDTO $cadastrarContaDTO
    ): static{
        $props = new ContaPropriedade();

        $props->nome = $cadastrarContaDTO->nome;
        $props->token = $cadastrarContaDTO->token;
        $props->waId = $cadastrarContaDTO->wa_id;

        return new static(
            $props
        );
    }

    public static function restore(
        RestaurarContaDTO $restaurarContaDTO,
        int $id
    ): static{
        $props = new ContaPropriedade();

        $props->nome = $restaurarContaDTO->nome;
        $props->token = $restaurarContaDTO->token;
        $props->waId = $restaurarContaDTO->wa_id;

        return new static(
            $props,
            Identificador::create($id)
        );
    }

    public function getToken(): string
    {
        return $this->props->token;
    }

    public function getNome(): string
    {
        return $this->props->nome;
    }

    public function getWaId(): string
    {
        return $this->props->waId;
    }
}
