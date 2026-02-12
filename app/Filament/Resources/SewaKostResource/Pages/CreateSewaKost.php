<?php

namespace App\Filament\Resources\SewaKostResource\Pages;

use App\Filament\Resources\SewaKostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\PropertyImage;

class CreateSewaKost extends CreateRecord
{
    protected static string $resource = SewaKostResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function afterCreate(): void
    {
        $data = $this->form->getState();

        // 1. Handle Images (existing logic)
        $images = $data['images'] ?? [];
        foreach ($images as $image) {
            PropertyImage::create([
                'properti_id' => $this->record->id,
                'path' => $image['path'],
                'is_primary' => $image['is_primary'] ?? false,
            ]);
        }

        // 2. Attach Agents from Master Property
        // Find the master property based on name (judul)
        // We exclude the current record to avoid self-reference (although likely safely handled)
        $masterProperty = \App\Models\Properti::where('judul', $this->record->judul)
            ->where('id', '!=', $this->record->id)
            ->first();

        if ($masterProperty) {
            // Attach agents from master to new rental
            $this->record->agens()->sync($masterProperty->agens->pluck('id'));
        }
    }


}
