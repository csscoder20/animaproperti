<?php

namespace App\Filament\Resources\MasterWilayahResource\Pages;

use App\Filament\Resources\MasterWilayahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterWilayah extends EditRecord
{
    protected static string $resource = MasterWilayahResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\DeleteAction::make(),
    //     ];
    // }
}
