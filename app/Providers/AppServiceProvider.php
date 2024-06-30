<?php

namespace App\Providers;

use A17\Twill\Facades\TwillAppSettings;
use A17\Twill\Facades\TwillNavigation;
use A17\Twill\Services\Settings\SettingsGroup;
use A17\Twill\View\Components\Navigation\NavigationLink;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        TwillNavigation::addLink(
            NavigationLink::make()->forModule('pages')->title('Блог')
        );
        TwillNavigation::addLink(
            NavigationLink::make()->forModule('menuLinks')->title('Меню')
        );
        TwillAppSettings::registerSettingsGroup(
            SettingsGroup::make()->name('homepage')->label('Главная')
        );

        Paginator::useBootstrap();
    }
}
