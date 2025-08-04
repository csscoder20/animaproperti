<?php

namespace App\Filament\Resources\PenjualanResource\Pages;

use App\Models\Penjualan;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\PenjualanResource;
use Filament\Pages\Actions\Action;

class InvoicePenjualan extends Page
{
    protected static string $resource = PenjualanResource::class;

    protected static string $view = 'filament.resources.invoice-penjualan';

    public $record;

    public function mount(Penjualan $record)
    {
        $this->record = $record;
    }

    public function getTitle(): string
    {
        return 'Invoice Penjualan';
    }
}
