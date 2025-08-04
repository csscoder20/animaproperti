<?php

namespace App\Filament\Resources\MasterWilayahResource\Pages;

use App\Filament\Resources\MasterWilayahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasterWilayahs extends ListRecords
{
    protected static string $resource = MasterWilayahResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }
}
