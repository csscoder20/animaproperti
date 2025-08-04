<?php

namespace App\Filament\Pages;

use App\Models\Kontak;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\Pengaturan;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class Contact extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.contact';
    protected static ?string $navigationLabel = 'Kontak';
    protected static ?string $modelLabel = 'Kontak';
    protected static ?string $title = 'Kontak';
    protected static ?string $navigationGroup = 'Halaman';

    protected static ?string $model = Kontak::class;

    public ?array $data = [];

    public static function getNavigationSort(): ?int
    {
        return 5;
    }


    public function mount(): void
    {
        $kontak = Kontak::first();
        if ($kontak) {
            $this->form->fill($kontak->toArray());
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Kontak Agen')
                    ->schema([
                        TextInput::make('judul')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('alamat')
                            ->label('Alamat')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->required(),
                        TextInput::make('telepon')
                            ->label('Nomor Telepon')
                            ->required(),
                        TextInput::make('whatsapp')
                            ->label('WhastApp')
                            ->required(),
                        TextInput::make('latitude')
                            ->label('Latitude')
                            ->required(),
                        TextInput::make('longitude')
                            ->label('Longitude')
                            ->required(),
                    ])->columns(3),
            ])
            ->statePath('data');
    }

    public function save()
    {
        $data = $this->form->getState();

        // Cek jika ada data, update data pertama, jika tidak, buat baru
        $kontak = Kontak::first();

        if ($kontak) {
            $kontak->update($data);
        } else {
            Kontak::create($data);
        }

        Notification::make()
            ->title('Kontak Diperbarui')
            ->body('Data kontak berhasil disimpan.')
            ->success()
            ->send();
    }
}
