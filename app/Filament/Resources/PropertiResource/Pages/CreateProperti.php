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

    protected array $tipeKamarImages = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->tipeKamarImages = $data['tipe_kamar_images'] ?? [];
        unset($data['tipe_kamar_images']);
    
        return $data;
    }

    protected function afterCreate(): void
    {
        $data = $this->form->getState();

        $images = $data['images'] ?? [];

        foreach ($images as $image) {
            \App\Models\PropertyImage::create([
                'properti_id' => $this->record->id,
                'path' => $image['path'],
                'is_primary' => $image['is_primary'] ?? false,
            ]);
        }

        if (!empty($this->tipeKamarImages)) {
            foreach ($this->tipeKamarImages as $tipeKamarId => $imagePath) {
                // Determine if imagePath is a single string or array. FileUpload without multiple() returns string.
                // But if the user uploaded something, it should be a path string.
                // Pivot 'gambar' is json column.
                // We'll save it as an array to be future proof or just the value.
                // Let's save it as is.
                $this->record->tipeKamars()->updateExistingPivot($tipeKamarId, ['gambar' => $imagePath]);
            }
        }
    }

    protected function getFormActions(): array
    {
        return [];
    }
}
