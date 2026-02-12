<?php

namespace App\Filament\Resources\SewaKostResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SewaKostResource;

class ListSewaKosts extends ListRecords
{
    protected static string $resource = SewaKostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

        ];
    }
}
