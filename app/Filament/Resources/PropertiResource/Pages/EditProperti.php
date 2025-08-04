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
}
