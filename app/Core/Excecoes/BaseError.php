<?php

namespace App\Core\Excecoes;

use Exception;
use Throwable;

abstract class BaseError extends Exception
{
    protected array $_detalhes;

    public function __construct(
        public readonly string $mensagem,
        public readonly string $nome,
        public readonly string $codigo,
        public readonly ?Throwable $previous = null
    ) {
        $this->_detalhes = array();
    }

    public function __toString()
    {
        return "{$this->nome}:{$this->codigo}";
    }

    public function hasDetalhes(): bool
    {
        return count($this->_detalhes) != 0;
    }

    public function getDetalhes()
    {
        return $this->_detalhes;
    }

    protected function addDetalhe(array $detalhe)
    {
        array_push($this->_detalhes, $detalhe);
    }

    public function setDetalhes(array $detalhes)
    {
        $this->_detalhes = $detalhes;
    }

    abstract static function pertence($excecao): ?BaseError;
}
