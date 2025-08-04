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
                    'id' => 'https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg',
                    'en' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/English_language.svg/1280px-English_language.svg.png',
                ]);
        });


        View::composer('*', function ($view) {
            $settings = Pengaturan::getAllAsArray();
            $view->with('settings', $settings);
        });
    }
}
