<?php

namespace App\Filament\Resources\SKPrivasiResource\Pages;

use App\Filament\Resources\SKPrivasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSKPrivasis extends ListRecords
{
    protected static string $resource = SKPrivasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
