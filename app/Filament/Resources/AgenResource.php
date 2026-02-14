<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\MasterWilayah;
use App\Models\Agen;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Fieldset;
use App\Filament\Resources\AgenResource\Pages;
use Doctrine\DBAL\Schema\Column;

class AgenResource extends Resource
{
    protected static ?string $model = Agen::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Agen';
    protected static ?string $pluralLabel = 'Agen';
    protected static ?string $slug = 'data-agen-properti';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Proses';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Identitas Agen')
                        ->columns(4)
                        ->schema([
                            Fieldset::make('Data Diri')
                                ->schema([
                                    TextInput::make('nama_lengkap')
                                        ->label('Nama Lengkap (Sesuai KTP)')
                                        ->required()
                                        ->maxLength(255),
                                    Select::make('gender')
                                        ->label('Jenis Kelamin')
                                        ->options([
                                            'Laki-laki' => 'Laki-laki',
                                            'Perempuan' => 'Perempuan',
                                        ])
                                        ->required()
                                        ->native(false),
                                    TextInput::make('birth_city')
                                        ->label('Kota Tempat Lahir')
                                        ->required()
                                        ->maxLength(255),
                                    DatePicker::make('birth_date')
                                        ->label('Tanggal Lahir')
                                        ->native(false)
                                        ->required(),
                                    TextInput::make('no_hp')
                                        ->label('No HP/WA')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('email')
                                        ->label('Email')
                                        ->email()
                                        ->required()
                                        ->maxLength(255),
                                    Select::make('social_media')
                                        ->label('Media Sosial')
                                        ->options([
                                            'facebook' => 'Facebook',
                                            'instagram' => 'Instagram',
                                            'twitter' => 'Twitter',
                                            'linkedin' => 'LinkedIn',
                                            'youtube' => 'YouTube',
                                        ])
                                        ->required()
                                        ->reactive(),

                                    TextInput::make('social_media_id')
                                        ->label('ID Media Sosial')
                                        ->placeholder('@ariana')
                                        ->required()
                                        ->maxLength(255)
                                        ->visible(fn($get) => $get('social_media')),

                                    Select::make('status')
                                        ->label('Status')
                                        ->options([
                                            'Pending' => 'Pending',
                                            'Approved' => 'Approved',
                                            'Rejected' => 'Rejected',
                                        ])
                                        ->default('Pending')
                                        ->required()
                                        ->visible(fn($livewire) => !($livewire instanceof Pages\CreateAgen)),
                                ])->columns(3),

                            Fieldset::make('Alamat')
                                ->schema([
                                    TextInput::make('alamat_lengkap')
                                        ->label('Alamat Tinggal')
                                        ->placeholder('Nama Jalan, No. Rumah, RT/RW')
                                        ->columnSpan(2)
                                        ->nullable(),
                                    TextInput::make('kode_pos')
                                        ->label('Kode Pos')
                                        ->nullable(),
                                ]),
                        ]),

                    Wizard\Step::make('Pendidikan & Pengalaman')
                        ->schema([
                            Fieldset::make('Pendidikan')
                                ->schema([
                                    Select::make('pendidikan')
                                        ->label('Jenjang')
                                        ->options([
                                            'SMA' => 'SMA/SMK',
                                            'D1' => 'Diploma 1 (D1)',
                                            'D2' => 'Diploma 2 (D2)',
                                            'D3' => 'Diploma 3 (D3)',
                                            'S1' => 'Sarjana (S1)',
                                            'S2' => 'Magister (S2)',
                                        ])
                                        ->required(),
                                    TextInput::make('nama_sekolah')
                                        ->label('Nama Sekolah')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('tahun_lulus')
                                        ->label('Tahun Lulus')
                                        ->numeric()
                                        ->minValue(1900)
                                        ->maxValue(now()->year)
                                        ->required(),
                                    TextInput::make('nilai_ipk')
                                        ->label('Nilai/IPK')
                                        ->required()
                                        ->numeric(),
                                ])->columns(3),
                            Fieldset::make('Pengalaman Kerja')
                                ->schema([
                                    TextInput::make('nama_perusahaan')
                                        ->label('Nama Perusahaan')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('tahun_masuk')
                                        ->label('Tahun Masuk')
                                        ->numeric()
                                        ->minValue(1900)
                                        ->maxValue(now()->year)
                                        ->required(),
                                    TextInput::make('tahun_keluar')
                                        ->label('Tahun Keluar')
                                        ->numeric()
                                        ->minValue(1900)
                                        ->maxValue(now()->year)
                                        ->required(),
                                    Textarea::make('alasan_keluar')
                                        ->label('Alasan Keluar')
                                        ->required()
                                        ->columnSpanFull(),
                                ])->columns(3),


                        ]),
                    Wizard\Step::make('Dokumen')
                        ->columns(5)
                        ->schema([
                            FileUpload::make('pas_foto')
                                ->label('Foto Pas')
                                ->previewable(true)
                                ->image()
                                ->maxSize(1024)
                                ->maxFiles(1)
                                ->disk('public')
                                ->directory('data-agen')
                                ->openable()
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->dehydrated(),

                            FileUpload::make('ktp')
                                ->label('KTP')
                                ->previewable(true)
                                ->image()
                                ->maxSize(1024)
                                ->maxFiles(1)
                                ->disk('public')
                                ->directory('data-agen')
                                ->openable()
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->dehydrated(),

                            FileUpload::make('cv')
                                ->label('CV')
                                ->previewable(true)
                                ->disk('public')
                                ->acceptedFileTypes(['application/pdf'])
                                ->maxSize(1024)
                                ->maxFiles(1)
                                ->directory('data-agen')
                                ->openable()
                                ->dehydrated(),
                            FileUpload::make('kartu_nama')
                                ->label('Kartu Nama')
                                ->previewable(true)
                                ->image()
                                ->maxSize(1024)
                                ->maxFiles(1)
                                ->disk('public')
                                ->directory('data-agen')
                                ->openable()
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->dehydrated(),
                            FileUpload::make('sertifikat_kompetensi')
                                ->label('Sertifikat Kompetensi')
                                ->previewable(true)
                                ->image()
                                ->maxSize(1024)
                                ->maxFiles(1)
                                ->directory('data-agen')
                                ->openable()
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->dehydrated(),
                            Toggle::make('perjanjian')
                                ->columnSpanFull()
                                ->label('Dengan mengeklik Submit, saya bertanggung jawab atas kebenaran data yang saya isi dalam formulir ini.')
                                ->required(),
                        ]),
                ])
                    ->columnSpanFull()
                    ->submitAction(new HtmlString(Blade::render(<<<BLADE
                            <x-filament::button
                                type="submit"
                                size="sm"
                            >
                                Submit
                            </x-filament::button>
                        BLADE)))
                    ->skippable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('birth_city')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('social_media')
                    ->searchable(),
                Tables\Columns\TextColumn::make('social_media_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Approved' => 'success',
                        'Rejected' => 'danger',
                        default => 'secondary',
                    })
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode_pos')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('pendidikan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_sekolah')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahun_lulus')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nilai_ipk')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sertifikat_kompetensi')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_perusahaan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahun_masuk')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tahun_keluar')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('pas_foto')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('ktp')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('cv')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\IconColumn::make('perjanjian')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgen::route('/'),
            'create' => Pages\CreateAgen::route('/create'),
            'edit' => Pages\EditAgen::route('/{record}/edit'),
        ];
    }
}
