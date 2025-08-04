<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->darkMode(false)
            ->id('admin')
            ->path('admin')
            ->brandName('ANIMA PROPERTI')
            ->login()
            ->colors([
                'danger' => Color::Red,
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'primary' => Color::Green,
                'success' => Color::Emerald,
                'warning' => Color::Orange,

            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                // Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])

            ->navigationGroups([
                'Master Data',
                'Proses',
                'Halaman',
            ])

            ->databaseNotifications()

            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->renderHook('panels::body.end', function () {
                return <<<'HTML'
                    <style>
                        .fi-topbar nav {
                            background-color: #0093dd;
                        }

                        nav.fi-sidebar-nav,
                        header.fi-sidebar-header {
                            background-color: #32404d;
                            height: 4rem;
                        }

                        .fi-sidebar-nav-groups li.fi-sidebar-item a:hover {
                            background-color: #374a5b !important;
                        }

                        .fi-sidebar-nav-groups li.fi-sidebar-item span.fi-sidebar-item-label {
                            color: #fff !important;
                            font-weight: normal;
                        }

                        li.fi-sidebar-item.fi-active.fi-sidebar-item-active a:hover {
                            background-color: transparent !important;
                        }

                        li.fi-sidebar-item.fi-active.fi-sidebar-item-active a {
                            background-color: #0093dd;
                        }

                        li.fi-sidebar-item.fi-active.fi-sidebar-item-active a svg,
                        li.fi-sidebar-item.fi-active.fi-sidebar-item-active a span {
                            color: #fff !important;
                        }

                        .fi-logo {
                            color: #fff;
                            max-width: 100% !important;
                            text-align: center;
                            width: 100%;
                            display: flex;
                            justify-content: center;
                        }

                        .fi-main {
                            min-width: 100rem important;
                        }

                        .max-w-7xl {
                            max-width: 100%;
                        }

                        .language-switch-trigger {
                            color: #fff;
                        }

                        .fi-ta-text {
                            padding: 0.45rem !important;
                        }

                        .fi-sidebar-nav::-webkit-scrollbar {
                            display: none;
                        }

                        .fi-sidebar-nav {
                            -ms-overflow-style: none;
                            scrollbar-width: none;
                        }

                        .fi-sidebar-nav-groups {
                           gap: 5px !important;
                        }

                        .fi-sidebar-nav {
                            padding-left: 1rem;
                            padding-right: 1rem;
                        }

                        .fi-sidebar-group-label {
                            color: lightblue;
                        }

                        main.fi-main {
                            padding-left: 1.5rem;
                            padding-right: 1.5rem;
                        }

                        .fi-ta-table thead tr {
                            background-color: #0093dd;
                        }
                        .fi-ta-table thead tr span {
                            color: #fff;
                        }

                        .fi-ta-actions span {
                            display: none;
                        }

                        button.fi-btn span.fi-btn-label {
                            display: inline;
                        }

                       .fi-ta-actions svg {
                            width: 1.3rem;
                            height: 1.3rem
                        }
                        
                        .fi-dropdown-list span {
                            display: inline;
                        }

                        .fi-topbar button svg.fi-icon-btn-icon {
                            color: #fff;
                        }
                        .ring-gray-200 {
                            --tw-ring-opacity: 1;
                            --tw-ring-color: transparent;
                        }
                        .fi-ta-table tbody tr:hover {
                            background-color: #f0f0f0;
                        }   
                        .rounded-md {
                            border-radius: 0;
                        }

                        .fi-fo-wizard-footer {
                            display: none !important;
                        }
                        
                        .fi-dropdown-panel .fi-dropdown-list-item-color-gray {
                            gap: 10px;
                        }

                        .fi-fo-repeater.grid.gap-y-4 .justify-center {
                            justify-content: start;
                        }
                    </style>
                HTML;
            })
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
