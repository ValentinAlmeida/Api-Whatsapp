<?php

namespace App\Providers;

use App\Core\Contratos\Repositorios\UsuarioRepositorio;
use App\Core\Contratos\Servicos\AutenticacaoService;
use App\Core\Eloquent\Repositorios\UsuarioRepositorio as RepositoriosUsuarioRepositorio;
use App\Core\Eloquent\Servicos\AutenticacaoService as ServicosAutenticacaoService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        UsuarioRepositorio::class => RepositoriosUsuarioRepositorio::class,

        AutenticacaoService::class => ServicosAutenticacaoService::class,
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
