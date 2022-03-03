<?php

namespace App\Providers;

use App\View\Composers\ProfileComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer('profile', ProfileComposer::class);

        // Using closure based composers...
        View::composer('dashboard', function ($view) {
            //
        });

        // Menu dinâmico solicita conta admin
        $menuContaAdmin = [
            'text' => 'Solicitação de Conta de Administrador',
            'url' => 'solicita',
            'can' => 'user',
        ];

        if (config('web-ldap-admin.solicitaContaAdmin') == 0) {
            $menuContaAdmin = [];
        } elseif (config('web-ldap-admin.solicitaContaAdmin') == 2) {
            $menuContaAdmin['can'] = 'servidor';
        }

        \UspTheme::addMenu('solicitaContaAdmin', $menuContaAdmin);
    }
}