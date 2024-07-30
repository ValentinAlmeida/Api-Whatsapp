<?php

namespace App\Services;

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Signer\Key;
use DateTimeImmutable;

class JwtService
{
    protected $config;

    public function __construct()
    {
        $this->config = Configuration::forSymmetricSigner(
            new Sha256(),
            Key\InMemory::plainText(config('jwt.secret'))
        );
    }

    public function createToken(array $claims): string
    {
        $now = new DateTimeImmutable();

        $token = $this->config->builder()
            ->issuedBy(config('app.url')) // Emissor
            ->issuedAt($now) // Data de emissão
            ->canOnlyBeUsedAfter($now) // Tempo de espera
            ->expiresAt($now->modify('+1 hour')) // Data de expiração
            ->withClaim('uid', $claims['uid']) // Claims personalizados
            ->getToken($this->config->signer(), $this->config->signingKey());

        return $token->toString();
    }

    public function validateToken(string $token): bool
    {
        try {
            $token = $this->config->parser()->parse($token);
            assert($token instanceof UnencryptedToken);

            return $this->config->validator()->validate($token, ...$this->config->validationConstraints());
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getClaims(string $token): array
    {
        $token = $this->config->parser()->parse($token);
        assert($token instanceof UnencryptedToken);

        return $token->claims()->all();
    }
}
