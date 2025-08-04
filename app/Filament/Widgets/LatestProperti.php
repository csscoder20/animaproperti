<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Pengaduan;
use App\Models\Properti;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestProperti extends BaseWidget
{
    protected static ?string $heading = '5 Properti Terbaru';
    protected static ?int $sort = 4;

    protected function getTableQuery(): Builder
    {
        return Properti::query()->latest()->limit(5);
    }

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
            Tables\Columns\TextColumn::make('judul')->label('Judul')->sortable(),
            Tables\Columns\TextColumn::make('harga')->label('Harga')->money('IDR', true)->sortable(),
            Tables\Columns\BadgeColumn::make('status')->label('Status')->colors([
                'success' => 'Tersedia',
                'danger' => fn($state) => in_array($state, ['Terjual', 'Tersewa']),
                'gray' => 'Tidak Aktif',
            ]),
            Tables\Columns\TextColumn::make('penawaran')->label('Penawaran'),
            Tables\Columns\IconColumn::make('unggulan')->label('Unggulan')->boolean(),
            Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->date('d M Y'),
        ];
    }

    public function getColumnSpan(): int | string | array
    {
        return 'full';
    }
}
