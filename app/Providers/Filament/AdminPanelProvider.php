<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use App\Models\Pengaturan;
use Filament\PanelProvider;
use Filament\Enums\ThemeMode;
use App\Filament\Pages\Settings;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;



class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->darkMode(false)
            ->id('admin')
            ->userMenuItems([
                MenuItem::make()
                    ->label('Kunjungi Web')
                    ->url('/')
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-globe-alt'),
            ])

            ->path('admin')
            ->brandName('SISPENDIK BINTUNI')
            ->sidebarFullyCollapsibleOnDesktop()
            ->defaultThemeMode(ThemeMode::Light)
            ->favicon(function () {
                $favicon = Pengaturan::getValue('favicon');

                return $favicon
                    ? asset('storage/' . $favicon)
                    : asset('themes/frontend/assets/img/favicon-32x32.png');
            })
            ->brandLogo(fn() => view('filament.admin.logo'))
            ->brandLogoHeight('4rem')
            ->login()
            ->passwordReset()
            ->emailVerification()
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
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->renderHook('panels::body.end', function () {
                return <<<'HTML'
                    <style>
                        /* .fi-logo {
                            color: #fff;
                        } */

                        .fi-topbar nav {
                            background-color: #0093dd;
                        }

                        .fi-sidebar-nav {
                            padding-top: 1rem;
                        }

                        nav.fi-sidebar-nav,
                        header.fi-sidebar-header {
                            background-color: #32404d;
                            height: 5rem;
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

                        li.fi-sidebar-item.fi-active.fi-sidebar-item-active a svg {
                            color: #fff !important;
                        }

                        a.fi-sidebar-item-button span>span {
                            background: #ecf0f6 !important;
                            border-radius: 5px;
                        }
                        a.fi-sidebar-item-button span>span>span>span {
                            color: #000 !important;
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
