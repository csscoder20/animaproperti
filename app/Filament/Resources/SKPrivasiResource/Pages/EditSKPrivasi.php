<?php

namespace App\Filament\Resources\SKPrivasiResource\Pages;

use App\Filament\Resources\SKPrivasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSKPrivasi extends EditRecord
{
    protected static string $resource = SKPrivasiResource::class;

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
