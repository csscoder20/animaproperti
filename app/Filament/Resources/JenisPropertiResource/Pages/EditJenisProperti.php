<?php

namespace App\Filament\Resources\JenisPropertiResource\Pages;

use App\Filament\Resources\JenisPropertiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisProperti extends EditRecord
{
    protected static string $resource = JenisPropertiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
