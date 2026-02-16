<?php

namespace App\Filament\Resources\PropertiResource\Pages;

use Filament\Actions;
use App\Models\MasterWilayah;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PropertiResource;

class EditProperti extends EditRecord
{
    protected static string $resource = PropertiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mounted(): void
    {
        $kode = str_replace('.', '', $this->record->kelurahan);

        $this->form->fill([
            'provinsi' => MasterWilayah::whereRaw("REPLACE(kode, '.', '') = ?", [substr($kode, 0, 2)])->value('kode'),
            'kabupaten' => MasterWilayah::whereRaw("REPLACE(kode, '.', '') = ?", [substr($kode, 0, 4)])->value('kode'),
            'kecamatan' => MasterWilayah::whereRaw("REPLACE(kode, '.', '') = ?", [substr($kode, 0, 6)])->value('kode'),
            'kelurahan' => $this->record->kelurahan,
        ]);
    }
    protected array $tipeKamarImages = [];

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $this->record->load('tipeKamars');
        
        foreach ($this->record->tipeKamars as $tipeKamar) {
            if ($tipeKamar->pivot->gambar) {
                $data['tipe_kamar_images'][$tipeKamar->id] = $tipeKamar->pivot->gambar;
            }
        }
    
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->tipeKamarImages = $data['tipe_kamar_images'] ?? [];
        unset($data['tipe_kamar_images']);
    
        return $data;
    }

    protected function afterSave(): void
    {
        if (!empty($this->tipeKamarImages)) {
            foreach ($this->tipeKamarImages as $tipeKamarId => $imagePath) {
                $this->record->tipeKamars()->updateExistingPivot($tipeKamarId, ['gambar' => $imagePath]);
            }
        }
    }
}
