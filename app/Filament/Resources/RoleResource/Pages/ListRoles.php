<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Buat Hak Akses')
            // ->icon('heroicon-o-plus')
            // ->color('primary')
            // ->modalHeading('Buat Hak Akses Baru')
            // ->modalSubmitActionLabel('Simpan Hak Akses'),
        ];
    }
}
