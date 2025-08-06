<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Tables;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class ActiveUsers extends BaseWidget
{

    use HasWidgetShield;

    protected static ?string $heading = 'Pengguna Aktif Saat Ini';
    protected static ?int $sort = 6;
    protected int $pollInterval = 10;

    public function getTableRecordsPerPage(): int
    {
        return 5;
    }

    public function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label('Nama'),
            Tables\Columns\TextColumn::make('email')
                ->label('Email'),
            Tables\Columns\TextColumn::make('last_activity')
                ->label('Terakhir Aktif')
                ->formatStateUsing(function ($state) {
                    return $state ? Carbon::createFromTimestamp($state)->diffForHumans() : '-';
                })
                ->sortable(),
        ];
    }
}
