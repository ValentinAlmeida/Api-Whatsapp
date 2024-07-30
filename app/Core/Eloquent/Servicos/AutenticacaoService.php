<?php

namespace App\Core\Eloquent\Servicos;

use App\Core\Contratos\Autenticavel;
use App\Core\Contratos\Repositorios\UsuarioRepositorio;
use App\Core\Contratos\Servicos\AutenticacaoService as Contrato;
use App\Core\Contratos\Token;
use App\Core\Entidades\Usuario;
use App\Core\Excecoes\Recursos\AutenticacaoExcecao;
use App\Core\Excecoes\Recursos\UsuarioExcecao;
use App\Core\VO\Credencial;
use App\Core\VO\TokenJwt;
use App\Support\Serializers\UsuarioSerializer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class AutenticacaoService implements Contrato
{
   public function autenticar(Credencial $credencial): Response
    {
        $usuarioRepo = App::make(UsuarioRepositorio::class);

        $usuario = $usuarioRepo->encontrarByEmail($credencial->email);

        throw_if(!$usuario, UsuarioExcecao::naoEncontrado());

        $this->verificarSenha($credencial->senha, $usuario);

        $token = $this->gerarToken($usuario);

        return UsuarioSerializer::parseEntidade($usuario, $token);
    }

    private function verificarSenha(string $senha, Usuario $usuario)
    {
        if (!Hash::check($senha, $usuario->senha)) {
            throw AutenticacaoExcecao::credenciaisInvalidas();
        }
    }

    public function gerarToken(Autenticavel $autenticavel, array $extra = null): Token
    {
        return TokenJwt::gerar('autenticado', $autenticavel);
    }

    public function validarToken(string $token): Token
    {
        $tokenTipo = substr($token, 0, 7);
        $token = substr($token, 7);

        if ($tokenTipo !== 'Bearer ') {
            throw AutenticacaoExcecao::tokenInvalido($token);
        }

        if (!$token) {
            throw AutenticacaoExcecao::tokenNaoEncontrado();
        }

        try {
            $parsedToken = TokenJwt::parse($token);
        } catch (\Lcobucci\JWT\Token\InvalidTokenStructure $th) {
            throw AutenticacaoExcecao::tokenInvalido($token);
        } catch (\Lcobucci\JWT\Encoding\CannotDecodeContent $th) {
            throw AutenticacaoExcecao::tokenInvalido($token);
        }

        throw_if(!TokenJwt::validar($parsedToken), AutenticacaoExcecao::tokenInvalido($parsedToken->toString()));

        return TokenJwt::transformar('autenticado', $parsedToken);
    }

    public function getAutenticavelPorToken(string $token): Autenticavel
    {
        $token = $this->validarToken($token);
        $payload = TokenJwt::getPayload('autenticado', $token->toString());

        return Usuario::build(
            $payload['id'],
            $payload['nome'],
            $payload['email'],
            $payload['senha'],
        );
    }
}
