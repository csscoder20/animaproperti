<?php

namespace App\Filament\Resources\AgenResource\Pages;

use App\Filament\Resources\AgenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgen extends ListRecords
{
    protected static string $resource = AgenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Agen'),
        ];
    }
}
