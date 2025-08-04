<?php

namespace App\Filament\Resources\JenisPropertiResource\Pages;

use App\Filament\Resources\JenisPropertiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisPropertis extends ListRecords
{
    protected static string $resource = JenisPropertiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
