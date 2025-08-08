<?php

namespace App\Filament\Resources\PropertiResource\Pages;

use App\Filament\Resources\PropertiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\PropertyImage;

class CreateProperti extends CreateRecord
{
    protected static string $resource = PropertiResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function afterCreate(): void
    {
        $data = $this->form->getState();

        $images = $data['images'] ?? [];

        foreach ($images as $image) {
            PropertyImage::create([
                'properti_id' => $this->record->id,
                'path' => $image['path'],
                'is_primary' => $image['is_primary'] ?? false,
            ]);
        }
    }

    protected function getFormActions(): array
    {
        return [];
    }
}
