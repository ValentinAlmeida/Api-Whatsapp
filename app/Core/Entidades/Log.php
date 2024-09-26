<?php

namespace App\Core\Entidades;

use App\Core\DTO\CadastrarLogDTO;
use App\Core\DTO\RestaurarLogDTO;
use App\Core\Entidade;
use App\Core\Negocios\Conta;
use App\Core\Propriedade\LogPropriedade;
use App\Core\VO\Identificador;

class Log extends Entidade
{
    private LogPropriedade $props;

    private function __construct(
        LogPropriedade $props,
        ?Identificador $identificador = null
    ) {
        parent::__construct(
            $identificador,
        );

        $this->props = $props;
    }

    public static function create(
        CadastrarLogDTO $cadastrarLogDTO
    ): static
    {
        $props = new LogPropriedade();

        $props->contaRef = $cadastrarLogDTO->conta_id;
        $props->mensagem = $cadastrarLogDTO->mensagem;

        return new static(
            $props
        );
    }

    public static function restore(
        RestaurarLogDTO $restaurarLogDTO,
        int $id
    ): static
    {
        $props = new LogPropriedade();

        $props->mensagem = $restaurarLogDTO->mensagem;
        $props->contaRef = $restaurarLogDTO->contaRef;
        $props->data_cadastro = $restaurarLogDTO->data_cadastro;

        return new static(
            $props,
            Identificador::create($id)
        );
    }

    public function getMensagem(): string
    {
        return $this->props->mensagem;
    }

    public function getConta(): Conta
    {
        return $this->props->conta;
    }

    public function getContaRef(): int
    {
        return $this->props->contaRef;
    }

    public function setConta(Conta $conta): void
    {
        $this->props->conta = $conta;
    }
}
