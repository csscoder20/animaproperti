<?php

namespace App\Filament\Resources\JenisPropertiResource\Pages;

use App\Filament\Resources\JenisPropertiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJenisProperti extends CreateRecord
{
    protected static string $resource = JenisPropertiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
