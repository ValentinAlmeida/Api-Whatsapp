<?php

namespace App\Providers;

use App\Core\Contratos\Repositorios\ContatoRepositorio;
use App\Core\Contratos\Repositorios\MensagemRepositorio;
use App\Core\Contratos\Repositorios\UsuarioRepositorio;
use App\Core\Contratos\Repositorios\WebhookRepositorio;
use App\Core\Contratos\Servicos\AutenticacaoService;
use App\Core\Contratos\Servicos\ContatoService;
use App\Core\Contratos\Servicos\MensagemService;
use App\Core\Contratos\Servicos\WebhookService;
use App\Core\Eloquent\Repositorios\ContatoRepositorio as RepositoriosContatoRepositorio;
use App\Core\Eloquent\Repositorios\MensagemRepositorio as RepositoriosMensagemRepositorio;
use App\Core\Eloquent\Repositorios\UsuarioRepositorio as RepositoriosUsuarioRepositorio;
use App\Core\Eloquent\Repositorios\WebhookRepositorio as RepositoriosWebhookRepositorio;
use App\Core\Eloquent\Servicos\AutenticacaoService as ServicosAutenticacaoService;
use App\Core\Eloquent\Servicos\ContatoService as ServicosContatoService;
use App\Core\Eloquent\Servicos\MensagemService as ServicosMensagemService;
use App\Core\Eloquent\Servicos\WebhookService as ServicosWebhookService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        UsuarioRepositorio::class => RepositoriosUsuarioRepositorio::class,
        WebhookRepositorio::class => RepositoriosWebhookRepositorio::class,
        ContatoRepositorio::class => RepositoriosContatoRepositorio::class,
        MensagemRepositorio::class => RepositoriosMensagemRepositorio::class,

        AutenticacaoService::class => ServicosAutenticacaoService::class,
        WebhookService::class => ServicosWebhookService::class,
        ContatoService::class => ServicosContatoService::class,
        MensagemService::class => ServicosMensagemService::class,
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
