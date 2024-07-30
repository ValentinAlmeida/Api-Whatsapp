<?php

namespace App\Core\Excecoes;

use App\Core\Excecoes\Enumeracoes\AutorizacaoError as Enumeracao;

class AutorizacaoError extends BaseError
{
    private function __construct(
        string $mensagem,
        string $codigo,
        string $recurso,
        ?string $campo = null,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($mensagem, 'AutorizacaoError', $codigo, $previous);

        $this->addDetalhe(['recurso' => $recurso, 'campo' => $campo]);
    }

    public static function pertence($excecao): ?BaseError
    {
        return match ($excecao->codigo) {
            Enumeracao::NAO_AUTORIZADO->codigo() => self::naoAutorizado($excecao->recurso, $excecao->campo, $excecao->previous),
            default => null
        };
    }

    public static function naoAutorizado(string $recurso, ?string $campo = null, ?\Throwable $previous = null)
    {
        return new static(
            Enumeracao::NAO_AUTORIZADO->mensagem(),
            Enumeracao::NAO_AUTORIZADO->codigo(),
            $recurso,
            $campo,
            $previous,
        );
    }
}
