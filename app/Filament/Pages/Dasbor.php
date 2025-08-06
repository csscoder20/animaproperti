<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\LatestUsers;
use App\Filament\Widgets\LatestProperti;
use App\Filament\Widgets\CustomDashboardStats;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class Dasbor extends Page
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.dashboard';
    protected static ?string $title = 'Dashboard';

    public function getHeaderWidgets(): array
    {
        return [
            CustomDashboardStats::class,
            LatestProperti::class,
            LatestUsers::class,
        ];
    }
}
