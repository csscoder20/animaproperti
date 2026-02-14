<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Properti;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\JenisProperti;
use App\Models\MasterWilayah;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\PropertiResource\Pages;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class PropertiResource extends Resource
{
    protected static ?string $model = Properti::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationLabel = 'Properti';
    protected static ?string $pluralModelLabel = 'Properti';
    protected static ?string $modelLabel = 'Properti';
    protected static ?string $slug = 'data-properti';
    protected static ?string $navigationGroup = 'Proses';
    protected static ?int $navigationSort = 2;

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Detail Properti')
                        ->columns(3)
                        ->schema([
                            Select::make('agen_id')
                                ->label('Agen')
                                ->relationship(
                                    name: 'agens',
                                    titleAttribute: 'nama_lengkap',
                                    modifyQueryUsing: fn($query) => $query->where('status', 'Approved'),
                                )
                                ->searchable()
                                ->preload()
                                ->multiple()
                                ->live()
                                ->required(),

                            TextInput::make('judul')
                                ->label('Nama Properti')
                                ->required()
                                ->maxLength(255)
                                ->lazy()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $set('slug', Str::slug($state));
                                }),

                            TextInput::make('slug')
                                ->label('Slug')
                                ->maxLength(255)
                                ->readonly()
                                ->dehydrated(),

                            Select::make('jenis_properti_id')
                                ->label('Jenis Properti')
                                ->relationship('jenisProperti', 'nama')
                                ->searchable()
                                ->preload()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $nama = JenisProperti::find($state)?->nama;
                                    $set('jenis_properti_nama', $nama);
                                })
                                ->required(),

                            Forms\Components\Hidden::make('jenis_properti_nama'),

                            Forms\Components\TextInput::make('harga')
                                ->label('Harga')
                                ->numeric()
                                ->required(),

                            Forms\Components\TextInput::make('tahun_dibangun')
                                ->label('Tahun Dibangun')
                                ->numeric()
                                ->minValue(1900)
                                ->maxValue(now()->year)
                                ->nullable()
                                ->default('0')
                                ->dehydrateStateUsing(fn($state, $get) => $get('jenis_properti_nama') === 'Tanah' ? '-' : $state)
                                ->visible(fn($get) => $get('jenis_properti_nama') !== 'Tanah'),

                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    'Tersedia' => 'Tersedia',
                                    'Terjual' => 'Terjual',
                                    'Tersewa' => 'Tersewa',
                                    'Tidak Aktif' => 'Tidak Aktif',
                                ])
                                ->default('Tersedia')
                                ->required()
                                ->visible(fn($livewire) => !($livewire instanceof Pages\CreateProperti)),

                            Forms\Components\Select::make('penawaran')
                                ->label('Penawaran')
                                ->options([
                                    'Dijual' => 'Dijual',
                                    'Disewa' => 'Disewa',
                                ])
                                ->required(),

                            Toggle::make('unggulan')
                                ->label('Unggulan'),

                            RichEditor::make('deskripsi')
                                ->label('Deskripsi')
                                ->columnSpanFull()
                                ->required(),
                            
                            Section::make('Fasilitas')
                                ->schema([
                                    Forms\Components\CheckboxList::make('fasilitas')
                                        ->label('Fasilitas Properti')
                                        ->relationship('fasilitas', 'nama')
                                        ->columns(3)
                                        ->gridDirection('row')
                                        ->bulkToggleable()
                                ]),
                        ]),
                    Wizard\Step::make('Lokasi')
                        ->columns(4)
                        ->schema([
                            Select::make('provinsi')
                                ->label('Provinsi')
                                ->searchable()
                                ->preload()
                                ->options(
                                    fn() =>
                                    MasterWilayah::query()
                                        ->whereRaw("LENGTH(REPLACE(kode, '.', '')) = 2")
                                        ->pluck('nama', 'kode')
                                )
                                ->reactive()
                                ->afterStateUpdated(fn($state, callable $set) => [
                                    $set('kabupaten', null),
                                    $set('kecamatan', null),
                                    $set('kelurahan', null),
                                ])
                                ->required(),

                            Select::make('kabupaten')
                                ->label('Kabupaten/Kota')
                                ->searchable()
                                ->preload()
                                ->options(
                                    fn(callable $get) =>
                                    $get('provinsi')
                                    ? MasterWilayah::query()
                                        ->whereRaw("LENGTH(REPLACE(kode, '.', '')) = 4")
                                        ->where('kode', 'like', substr(str_replace('.', '', $get('provinsi')), 0, 2) . '%')
                                        ->pluck('nama', 'kode')
                                    : []
                                )
                                ->reactive()
                                ->afterStateUpdated(fn($state, callable $set) => [
                                    $set('kecamatan', null),
                                    $set('kelurahan', null),
                                ])
                                ->required(),

                            Select::make('kecamatan')
                                ->label('Kecamatan')
                                ->searchable()
                                ->preload()
                                ->options(
                                    fn(callable $get) =>
                                    $get('kabupaten')
                                    ? MasterWilayah::query()
                                        ->whereRaw("LENGTH(REPLACE(kode, '.', '')) = 6")
                                        ->where('kode', 'like', MasterWilayah::formatKodeWithDots(substr(str_replace('.', '', $get('kabupaten')), 0, 4)) . '.%')
                                        ->pluck('nama', 'kode')
                                    : []
                                )
                                ->reactive()
                                ->afterStateUpdated(fn($state, callable $set) => $set('kelurahan', null))
                                ->required(),


                            Select::make('kelurahan')
                                ->label('Kelurahan/Desa')
                                ->searchable()
                                ->preload()
                                ->options(
                                    fn(callable $get) =>
                                    $get('kecamatan')
                                    ? MasterWilayah::query()
                                        ->whereRaw("LENGTH(REPLACE(kode, '.', '')) IN (10, 12)")
                                        ->where('kode', 'like', MasterWilayah::formatKodeWithDots(substr(str_replace('.', '', $get('kecamatan')), 0, 6)) . '.%')
                                        ->pluck('nama', 'kode')
                                    : []
                                )
                                ->reactive()
                                ->required()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    if ($state) {
                                        $kode = str_replace('.', '', $state);
                                        $prov = substr($kode, 0, 2);
                                        $kab = substr($kode, 0, 4);
                                        $kec = substr($kode, 0, 6);

                                        $set('provinsi', MasterWilayah::whereRaw("REPLACE(kode, '.', '') = ?", [$prov])->value('kode'));
                                        $set('kabupaten', MasterWilayah::whereRaw("REPLACE(kode, '.', '') = ?", [$kab])->value('kode'));
                                        $set('kecamatan', MasterWilayah::whereRaw("REPLACE(kode, '.', '') = ?", [$kec])->value('kode'));
                                    }
                                }),


                            TextInput::make('kode_pos')
                                ->nullable()
                                ->maxLength(10),
                            TextInput::make('alamat_lengkap')
                                ->label('Alamat Jalan')
                                ->placeholder('Nama Jalan, No. Rumah, RT/RW')
                                ->nullable(),
                        ]),

                    Wizard\Step::make('Spesifikasi')
                        ->columns(6)
                        ->schema([
                            Forms\Components\TextInput::make('jenis_cluster')
                                ->label('Cluster')
                                ->default('-')
                                ->dehydrateStateUsing(fn($state, $get) => $get('jenis_properti_nama') === 'Tanah' ? '-' : $state)
                                ->required()
                                ->dehydrated()
                                ->visible(fn($get) => $get('jenis_properti_nama') !== 'Tanah'),

                            Forms\Components\TextInput::make('tipe_perumahan')
                                ->label('Tipe')
                                ->default('-')
                                ->dehydrateStateUsing(fn($state, $get) => $get('jenis_properti_nama') === 'Tanah' ? '-' : $state)
                                ->required()
                                ->dehydrated()
                                ->visible(fn($get) => $get('jenis_properti_nama') !== 'Tanah'),

                            Forms\Components\TextInput::make('jumlah_kamar_tidur')
                                ->label('Kamar Tidur')
                                ->numeric()
                                ->default(0)
                                ->dehydrateStateUsing(fn($state, $get) => $get('jenis_properti_nama') === 'Tanah' ? 0 : $state)
                                ->required()
                                ->dehydrated()
                                ->visible(fn($get) => $get('jenis_properti_nama') !== 'Tanah'),

                            Forms\Components\TextInput::make('jumlah_kamar_mandi')
                                ->label('Kamar Mandi')
                                ->numeric()
                                ->default(0)
                                ->dehydrateStateUsing(fn($state, $get) => $get('jenis_properti_nama') === 'Tanah' ? 0 : $state)
                                ->required()
                                ->dehydrated()
                                ->visible(fn($get) => $get('jenis_properti_nama') !== 'Tanah'),

                            Forms\Components\TextInput::make('luas_bangunan')
                                ->label('Luas Bangunan (m²)')
                                ->numeric()
                                ->default(0)
                                ->dehydrateStateUsing(fn($state, $get) => $get('jenis_properti_nama') === 'Tanah' ? 0 : $state)
                                ->required()
                                ->dehydrated()
                                ->visible(fn($get) => $get('jenis_properti_nama') !== 'Tanah'),

                            Forms\Components\TextInput::make('luas_tanah')
                                ->label('Luas Tanah (m²)')
                                ->numeric()
                                ->required(),
                        ]),

                    Wizard\Step::make('Ketersediaan (Sewa)')
                        ->columns(2)
                        ->schema([
                            Forms\Components\TextInput::make('jumlah_kamar')
                                ->label('Jumlah Kamar Tersedia')
                                ->numeric()
                                ->default(1)
                                ->required(),
                            Forms\Components\TextInput::make('kapasitas_tamu')
                                ->label('Kapasitas Tamu per Kamar')
                                ->numeric()
                                ->default(1)
                                ->required(),
                            Forms\Components\DatePicker::make('tersedia_dari')
                                ->label('Tersedia Dari')
                                ->native(false)
                                ->displayFormat('d M Y'),
                            Forms\Components\DatePicker::make('tersedia_sampai')
                                ->label('Tersedia Sampai')
                                ->native(false)
                                ->displayFormat('d M Y'),
                        ])
                        ->visible(fn($get) => $get('penawaran') === 'Disewa'),

                    Wizard\Step::make('Data Pendukung')
                        ->schema([
                            Section::make('Link')
                                ->schema([
                                    Forms\Components\TextInput::make('link_brosur')
                                        ->label('Link Brosur')
                                        ->required(),
                                    Forms\Components\TextInput::make('link_layout')
                                        ->label('Link Layout')
                                        ->required(),
                                    Forms\Components\TextInput::make('link_spesifikasi')
                                        ->label('Link Spesifikasi')
                                        ->required(),
                                    Forms\Components\TextInput::make('link_site_plan')
                                        ->label('Link Site Plan')
                                        ->required(),
                                ])->columns(2),
                            Section::make('Gambar')
                                ->schema([
                                    FileUpload::make('gbr_primary_properti')
                                        ->label('Properti')
                                        ->previewable(true)
                                        ->image()
                                        ->maxSize(1024)
                                        ->maxFiles(1)
                                        ->directory('data-pendukung')
                                        ->openable()
                                        ->imageEditor()
                                        ->imageEditorAspectRatios([
                                            '16:9',
                                            '4:3',
                                            '1:1',
                                        ])
                                        ->dehydrated(),

                                    Forms\Components\Repeater::make('images')
                                        ->label('')
                                        ->schema([
                                            Forms\Components\FileUpload::make('path')
                                                ->label('')
                                                ->image()
                                                ->directory('property-images')
                                                ->previewable(true)
                                                ->imagePreviewHeight('150')
                                                ->imageEditor()
                                                ->imageEditorAspectRatios([
                                                    '16:9',
                                                    '4:3',
                                                    '1:1',
                                                ])
                                                ->required(),
                                        ])
                                        ->columnSpan(6)
                                        ->grid(6)
                                        ->createItemButtonLabel('Tambah Gambar Properti')
                                        ->collapsible()
                                        ->collapsed(false)
                                        ->dehydrated(true)
                                        ->relationship('images')
                                        ->deletable(true)
                                        ->default([]),
                                ])->columns(2)
                        ]),
                ])
                    ->columnSpanFull()
                    ->submitAction(new HtmlString(Blade::render(<<<BLADE
                            <x-filament::button form="create" type="submit">
                                Upload File
                            </x-filament::button>
                        BLADE)))
                    ->skippable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Nama Properti')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jenisProperti.nama')
                    ->label('Jenis Properti')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR', true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('tahun_dibangun')
                    ->label('Tahun')
                    ->sortable(),

                Tables\Columns\TextColumn::make('lokasi.nama')
                    ->label('Lokasi')
                    ->searchable(),

                Tables\Columns\TextColumn::make('jenis_cluster')
                    ->label('Cluster')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('tipe_perumahan')
                    ->label('Tipe')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('jumlah_kamar_tidur')
                    ->label('KT'),

                Tables\Columns\TextColumn::make('jumlah_kamar_mandi')
                    ->label('KM'),

                Tables\Columns\TextColumn::make('luas_bangunan')
                    ->label('LB (m²)'),

                Tables\Columns\TextColumn::make('luas_tanah')
                    ->label('LT (m²)'),

                Tables\Columns\BadgeColumn::make('status')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Status')
                    ->colors([
                        'success' => 'Tersedia',
                        'danger' => fn($state) => in_array($state, ['Terjual', 'Tersewa']),
                        'gray' => 'Tidak Aktif',
                    ]),

                Tables\Columns\TextColumn::make('penawaran')
                    ->label('Penawaran'),

                Tables\Columns\TextColumn::make('jumlah_kamar')
                    ->label('Jml Kamar')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('kapasitas_tamu')
                    ->label('Kps Tamu')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Tersedia' => 'Tersedia',
                        'Terjual' => 'Terjual',
                        'Tersewa' => 'Tersewa',
                        'Tidak Aktif' => 'Tidak Aktif',
                    ]),
                Tables\Filters\SelectFilter::make('penawaran')
                    ->options([
                        'Dijual' => 'Dijual',
                        'Disewa' => 'Disewa',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('duplicate')
                    ->label('Duplicate')
                    ->icon('heroicon-m-document-duplicate')
                    ->color('gray')
                    ->action(function ($record) {
                        $newRecord = $record->replicate();
                        $newTitle = $record->judul . ' (Copy)';
                        $newRecord->judul = $newTitle;
                        $newRecord->slug = Str::slug($newTitle) . '-' . Str::random(4);
                        $newRecord->save();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Duplicate Item')
                    ->modalSubheading('Apakah Anda yakin ingin menduplikasi item ini?')
                    ->modalButton('Ya, Duplikasi'),
            ])
            ->headerActions([
                FilamentExportHeaderAction::make('export')
                    ->disableAdditionalColumns()
                    ->withHiddenColumns()
                    ->disableCsv()
                    ->disablePreview(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPropertis::route('/'),
            'create' => Pages\CreateProperti::route('/create'),
            'edit' => Pages\EditProperti::route('/{record}/edit'),
        ];
    }
}
