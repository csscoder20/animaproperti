<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\TentangKami;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class AboutUs extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static string $view = 'filament.pages.about-us';
    protected static ?string $navigationLabel = 'Tentang Kami';
    protected static ?string $title = 'Tentang Kami';
    protected static ?string $navigationGroup = 'Halaman';

    public ?array $data = [];

    public static function getNavigationSort(): ?int
    {
        return 5;
    }

    public function mount(): void
    {
        $this->form->fill(TentangKami::getAllAsArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Identitas Perusahaan')
                    ->schema([
                        TextInput::make('about_title')
                            ->label('Nama Perusahaan')
                            ->columnSpanFull()
                            ->required(),
                        RichEditor::make('about_description')
                            ->label('Deskripsi Singkat Perusahaan')
                            ->required(),
                        RichEditor::make('visi')
                            ->label('Visi Perusahaan')
                            ->required(),
                        RichEditor::make('misi')
                            ->label('Misi Perusahaan')
                            ->required(),
                        FileUpload::make('about_image')
                            ->label('Logo Perusahaan')
                            ->image()
                            ->directory('about')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                    ])->columns(2),
                Fieldset::make('Statisik & Prestasi')
                    ->schema([
                        TextInput::make('property_sold')->label('Properti Terjual')->numeric(),
                        TextInput::make('happy_clients')->label('Klien Puas')->numeric(),
                        TextInput::make('years_of_experience')->label('Tahun Pengalaman')->numeric(),
                        TextInput::make('rating')->label('Rating Rata-rata')->numeric(),
                    ])->columns(4),
            ])
            ->statePath('data');
    }

    public function save()
    {
        $data = $this->form->getState();
        TentangKami::setBulk($data);

        Notification::make()
            ->title('Berhasil Disimpan')
            ->body('Halaman Tentang Kami telah diperbarui.')
            ->success()
            ->send();
    }
}
