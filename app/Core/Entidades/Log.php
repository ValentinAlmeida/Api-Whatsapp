<?php

namespace App\Core\Entidades;

use App\Core\DTO\CadastrarLogDTO;
use App\Core\DTO\RestaurarLogDTO;
use App\Core\Propriedade\LogPropriedade;
use App\Core\VO\Identificador;
use DateTimeInterface;

class Log
{
    private LogPropriedade $props;

    private ?int $id;

    private function __construct(
        LogPropriedade $props,
        ?int $id = null
    )
    {
        $this->props = $props;
        $this->id = $id;
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
            $id
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

    public function getDataCadastro(): DateTimeInterface
    {
        return $this->props->data_cadastro;
    }

    public function getContaRef(): int
    {
        return $this->props->contaRef;
    }

    public function setConta(Conta $conta): void
    {
        $this->props->conta = $conta;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
