<?php

namespace App\Filament\Pages;

use App\Models\Pengaturan;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\RichEditor;
use Illuminate\Support\Facades\Storage;

class Settings extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.setting';
    protected static ?string $navigationLabel = 'Pengaturan';
    protected static ?string $modelLabel = 'Pengaturan';
    // protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $title = 'Pengaturan';
    protected static ?string $navigationGroup = 'Halaman';

    public ?array $data = [];

    public static function getNavigationSort(): ?int
    {
        return 5;
    }


    public function mount(): void
    {
        $this->form->fill(Pengaturan::getAllAsArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Pengaturan Web')
                            ->icon('heroicon-m-paint-brush')
                            ->schema([
                                Fieldset::make('Identitas Web')
                                    ->schema([
                                        TextInput::make('site_name')
                                            ->label('Nama Web')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('site_description')
                                            ->label('Deskripsi')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('site_tagline')
                                            ->label('Slogan')
                                            ->required(),
                                        TextInput::make('copyright')
                                            ->label('Hak Cipta')
                                            ->required(),
                                        TextInput::make('welcome_text')
                                            ->label('Welcome Text')
                                            ->required(),
                                        TextInput::make('address')
                                            ->label('Alamat')
                                            ->required(),
                                        TextInput::make('postal_code')
                                            ->label('Kode Pos')
                                            ->required(),
                                        TextInput::make('phone')
                                            ->label('Nomor HP')
                                            ->required(),
                                        TextInput::make('email')
                                            ->label('Email')
                                            ->required(),
                                    ])->columns(3),
                                Fieldset::make('Media Sosial')
                                    ->schema([
                                        TextInput::make('facebook')
                                            ->label('Facebook')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('instagram')
                                            ->label('Instagram')
                                            ->required(),
                                        TextInput::make('tiktok')
                                            ->label('Tiktok')
                                            ->required(),
                                        TextInput::make('youtube')
                                            ->label('Youtube')
                                            ->required(),
                                        TextInput::make('twitter')
                                            ->label('Twitter')
                                            ->required(),
                                    ])->columns(3),

                                Fieldset::make('Logo dan Favicon')
                                    ->schema([
                                        FileUpload::make('logo')
                                            ->previewable(true)
                                            ->image()
                                            ->maxSize(1024)
                                            ->maxFiles(1)
                                            ->directory('logos')
                                            ->openable(),
                                        FileUpload::make('favicon')
                                            ->previewable(true)
                                            ->image()
                                            ->maxSize(1024)
                                            ->maxFiles(1)
                                            ->directory('favicons')
                                            ->openable(),
                                    ])->columns(4)


                            ]),
                    ])
            ])
            ->statePath('data');
    }

    public function save()
    {
        $data = $this->form->getState();
        Pengaturan::setBulk($data);

        Notification::make()
            ->title('Settings Updated')
            ->body('Basic settings have been successfully updated.')
            ->success()
            ->send();
    }
}
