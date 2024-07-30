<?php

namespace App\Core\VO;

use App\Core\Contratos\Token;
use DateTimeImmutable;
use DateTimeInterface;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\JwtFacade as Facade;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token as JWTToken;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Validator;

class TokenJwt implements Token
{
    private UnencryptedToken $value;

    private function __construct(
        private readonly string $payload_name,
        private readonly mixed $payload,
        ?UnencryptedToken $token = null,
    ) {
        if ($token) {
            $this->value = $token;
        } else {
            $secret = self::secret();

            $this->value = (new Facade())->issue(
                new Sha256(),
                $secret,
                static fn (
                    Builder $builder,
                    DateTimeImmutable $issuedAt
                ) => $builder
                    ->withClaim($payload_name, $payload)
                    ->expiresAt($issuedAt->modify('+60 minutes'))
            );
        }
    }

    public static function transformar(string $payload_name, UnencryptedToken $token): Token
    {
        return new static(
            $payload_name,
            $token->claims()->get($payload_name),
            $token
        );
    }

    private static function secret()
    {
        return InMemory::plainText(
            env('JWT_SECRET', 'OSAKDMM0sad1923wkdamso123sdaskdsad2132ds')
        );
    }

    public static function parse(string $token): UnencryptedToken
    {
        $parser = new Parser(new JoseEncoder());
        $token = $parser->parse($token);

        return $token;
    }

    public static function getPayload(string $payload_name, string $token)
    {
        $token = self::parse($token);

        return $token->claims()->get($payload_name);
    }

    public static function validar(JWTToken $token)
    {
        $validator = new Validator();

        return $validator->validate($token, new SignedWith(new Sha256(), self::secret()));
    }

    public static function gerar(string $payload_name, mixed $payload)
    {
        return new static($payload_name, $payload);
    }

    public function getExpiracao(): DateTimeInterface
    {
        return $this->value->claims()->get('exp');
    }

    public function getTipo(): string
    {
        return 'Bearer';
    }

    public function toString(): string
    {
        return $this->value->toString();
    }
}
