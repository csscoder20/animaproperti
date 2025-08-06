<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use App\Models\Pengaturan;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['id', 'en'])

                ->flags([
                    'id' => asset('themes/img/flags/id.svg'),
                    'en' => asset('themes/img/flags/en.png'),
                ]);
        });


        View::composer('*', function ($view) {
            $settings = Pengaturan::getAllAsArray();
            $view->with('settings', $settings);
        });
    }
}
