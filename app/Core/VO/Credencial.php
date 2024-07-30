<?php

namespace App\Core\VO;

final class Credencial
{
    private function __construct(
        public readonly string $email,
        public readonly string $senha
    ) {}

    public static function create(string $email, string $senha): Credencial
    {
        return new Credencial($email, $senha);
    }
}
