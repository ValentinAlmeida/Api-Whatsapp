<?php

namespace App\Providers;

use App\Core\Contratos\Repositorios as ContratoRepositorio;
use App\Core\Contratos\Servicos as ContratoServico;
use App\Core\Eloquent\Repositorios as Repositorio;
use App\Core\Eloquent\Servicos as Servico;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        ContratoRepositorio\UsuarioRepositorio::class => Repositorio\UsuarioRepositorio::class,
        ContratoRepositorio\WebhookRepositorio::class => Repositorio\WebhookRepositorio::class,
        ContratoRepositorio\ContatoRepositorio::class => Repositorio\ContatoRepositorio::class,
        ContratoRepositorio\MensagemRepositorio::class => Repositorio\MensagemRepositorio::class,
        ContratoRepositorio\ContaRepositorio::class => Repositorio\ContaRepositorio::class,

        ContratoServico\AutenticacaoService::class => Servico\AutenticacaoService::class,
        ContratoServico\WebhookService::class => Servico\WebhookService::class,
        ContratoServico\ContatoService::class => Servico\ContatoService::class,
        ContratoServico\MensagemService::class => Servico\MensagemService::class,
        ContratoServico\ContaService::class => Servico\ContaService::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
