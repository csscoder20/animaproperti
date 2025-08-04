<?php

namespace App\Filament\Widgets;

use App\Models\JenisProperti;
use App\Models\User;
use App\Models\Properti;
use App\Models\Agen;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Filament\Widgets\Widget;

class CustomDashboardStats extends Widget
{
    protected static string $view = 'filament.widgets.custom-dashboard-stats';
    protected int | string | array $columnSpan = 'full';

    public function getViewData(): array
    {
        return [
            'cards' => [
                [
                    'title' => 'Total Properti',
                    'value' => Properti::count(),
                ],
                [
                    'title' => 'Total Users',
                    'value' => User::count(),
                ],
                [
                    'title' => 'Total Pelanggan',
                    'value' => Pelanggan::count(),
                ],
                [
                    'title' => 'Total Agen',
                    'value' => Agen::count(),
                ],
                [
                    'title' => 'Total Penjualan',
                    'value' => Penjualan::count(),
                ],
                [
                    'title' => 'Total Jenis Properti',
                    'value' => JenisProperti::count(),
                ],

            ],
        ];
    }
}
