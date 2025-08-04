<?php

namespace App\Filament\Resources\PenjualanResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PenjualanResource;
use App\Models\Pelanggan;

class CreatePenjualan extends CreateRecord
{
    protected static string $resource = PenjualanResource::class;

    public $pembeli_id;
    public $no_ktp;
    public $telepon;
    public $email;
    public $npwp;
    public $foto_ktp;
    public $foto_npwp;

    public function updatedPembeliId($value)
    {
        $pelanggan = Pelanggan::find($value);

        if ($pelanggan) {
            $this->no_ktp = $pelanggan->no_ktp;
            $this->telepon = $pelanggan->telepon;
            $this->email = $pelanggan->email;
            $this->npwp = $pelanggan->npwp;
            $this->foto_ktp = $pelanggan->foto_ktp;
            $this->foto_npwp = $pelanggan->foto_npwp;
        } else {
            $this->reset([
                'no_ktp',
                'telepon',
                'email',
                'npwp',
                'foto_ktp',
                'foto_npwp',
                'no_ktp',
            ]);
        }
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
