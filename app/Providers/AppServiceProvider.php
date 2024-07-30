<?php

namespace App\Providers;

use App\Core\Contratos\Repositorios\UsuarioRepositorio;
use App\Core\Contratos\Repositorios\WebhookRepositorio;
use App\Core\Contratos\Servicos\AutenticacaoService;
use App\Core\Contratos\Servicos\WebhookService;
use App\Core\Eloquent\Repositorios\UsuarioRepositorio as RepositoriosUsuarioRepositorio;
use App\Core\Eloquent\Repositorios\WebhookRepositorio as RepositoriosWebhookRepositorio;
use App\Core\Eloquent\Servicos\AutenticacaoService as ServicosAutenticacaoService;
use App\Core\Eloquent\Servicos\WebhookService as ServicosWebhookService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        UsuarioRepositorio::class => RepositoriosUsuarioRepositorio::class,
        WebhookRepositorio::class => RepositoriosWebhookRepositorio::class,

        AutenticacaoService::class => ServicosAutenticacaoService::class,
        WebhookService::class => ServicosWebhookService::class,
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
