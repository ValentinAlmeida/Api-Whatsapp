<?php

namespace App\Core\Excecoes;

use App\Core\Excecoes\Enumeracoes\AutenticacaoError as Enumeracao;

class AutenticacaoError extends BaseError
{
    private function __construct(
        string $mensagem,
        string $codigo,
        ?string $token = null,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($mensagem, 'AutenticacaoError', $codigo, $previous);

        if ($token) {
            $this->addDetalhe(['token' => $token]);
        }
    }

    public static function pertence($excecao): ?BaseError
    {
        return match ($excecao->codigo) {
            Enumeracao::CREDENCIAIS_INVALIDAS->codigo() => self::naoAutenticado($excecao->previous),
            Enumeracao::TOKEN_NAO_ENCONTRADO->codigo() => self::tokenNaoEncontrado($excecao->previous),
            Enumeracao::TOKEN_INVALIDO->codigo() => self::tokenInvalida($excecao->token, $excecao->previous),
            Enumeracao::TOKEN_EXPIRADO->codigo() => self::tokenExpirado($excecao->token, $excecao->previous),
            Enumeracao::ACESSO_BLOQUEADO->codigo() => self::acessoBloqueado(),
            default => null
        };
    }

    public static function naoAutenticado(?\Throwable $previous = null)
    {
        return new static(
            Enumeracao::CREDENCIAIS_INVALIDAS->mensagem(),
            Enumeracao::CREDENCIAIS_INVALIDAS->codigo(),
            null,
            $previous,
        );
    }

    public static function tokenNaoEncontrado(?\Throwable $previous = null)
    {
        return new static(
            Enumeracao::TOKEN_NAO_ENCONTRADO->mensagem(),
            Enumeracao::TOKEN_NAO_ENCONTRADO->codigo(),
            null,
            $previous,
        );
    }

    public static function tokenInvalida(string $token, ?\Throwable $previous = null)
    {
        return new static(
            Enumeracao::TOKEN_INVALIDO->mensagem(),
            Enumeracao::TOKEN_INVALIDO->codigo(),
            $token,
            $previous,
        );
    }

    public static function tokenExpirado(string $token, ?\Throwable $previous = null)
    {
        return new static(
            Enumeracao::TOKEN_EXPIRADO->mensagem(),
            Enumeracao::TOKEN_EXPIRADO->codigo(),
            $token,
            $previous,
        );
    }

    public static function acessoBloqueado()
    {
        return new static(
            Enumeracao::ACESSO_BLOQUEADO->mensagem(),
            Enumeracao::ACESSO_BLOQUEADO->codigo(),
        );
    }
}
