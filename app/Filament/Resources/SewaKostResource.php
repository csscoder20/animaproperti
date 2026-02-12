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
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\SewaKostResource\Pages;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class SewaKostResource extends Resource
{
    protected static ?string $model = Properti::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationLabel = 'Sewa';
    protected static ?string $pluralModelLabel = 'Sewa';
    protected static ?string $modelLabel = 'Sewa';
    protected static ?string $slug = 'sewa-kost-kontrakan';
    protected static ?string $navigationGroup = 'Proses';
    protected static ?int $navigationSort = 4;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('penawaran', 'Disewa')
            ->whereHas('jenisProperti', function ($q) {
                $q->whereIn('slug', ['kost', 'apartemen']);
            });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Properti')
                    ->schema([
                        Forms\Components\Select::make('judul')
                            ->label('Nama Properti')
                            ->options(function () {
                                return Properti::whereHas('jenisProperti', function ($q) {
                                    $q->whereIn('slug', ['kost', 'apartemen']);
                                })->pluck('judul', 'judul'); // Use judul as both key and value to store the name
                            })
                            ->searchable()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                if ($state) {
                                    $properti = Properti::where('judul', $state)->first();
                                    if ($properti) {
                                        $set('jenis_properti_id', $properti->jenis_properti_id);
                                        $set('slug', Str::slug($state) . '-' . Str::random(5));

                                        // Copy details from master property
                                        $set('gbr_primary_properti', $properti->gbr_primary_properti);
                                        $set('deskripsi', $properti->deskripsi);
                                        $set('alamat_lengkap', $properti->alamat_lengkap);
                                        $set('provinsi', $properti->provinsi);
                                        $set('kabupaten', $properti->kabupaten);
                                        $set('kecamatan', $properti->kecamatan);
                                        $set('kelurahan', $properti->kelurahan);
                                        $set('kode_pos', $properti->kode_pos);
                                        $set('luas_tanah', $properti->luas_tanah);
                                        $set('luas_bangunan', $properti->luas_bangunan);
                                        $set('jumlah_kamar_tidur', $properti->jumlah_kamar_tidur);
                                        $set('jumlah_kamar_mandi', $properti->jumlah_kamar_mandi);
                                        $set('tahun_dibangun', $properti->tahun_dibangun);
                                        $set('latitude', $properti->latitude);
                                        $set('longitude', $properti->longitude);
                                    }
                                }
                            }),

                        Forms\Components\Select::make('jenis_properti_id')
                            ->label('Jenis Properti')
                            ->relationship(
                                name: 'jenisProperti',
                                titleAttribute: 'nama',
                            )
                            ->disabled() // Readonly as requested
                            ->dehydrated() // Ensure it saves
                            ->required(),
                    ])->columns(2),

                Section::make('Detail Sewa')
                    ->schema([
                        Forms\Components\DatePicker::make('tersedia_dari')
                            ->label('Tersedia Dari')
                            ->native(false)
                            ->displayFormat('d M Y'),

                        Forms\Components\DatePicker::make('tersedia_sampai')
                            ->label('Tersedia Sampai')
                            ->native(false)
                            ->displayFormat('d M Y'),

                        Forms\Components\TextInput::make('jumlah_kamar')
                            ->label('Jumlah Room')
                            ->numeric()
                            ->default(1)
                            ->required(),

                        Forms\Components\TextInput::make('kapasitas_tamu')
                            ->label('Jumlah Tamu Diperbolehkan')
                            ->numeric()
                            ->default(1)
                            ->required(),

                        Forms\Components\TextInput::make('harga')
                            ->label('Harga per Room')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                // Hidden Fields for Required Columns
                Forms\Components\Hidden::make('slug'),
                Forms\Components\Hidden::make('penawaran')->default('Disewa'),
                Forms\Components\Hidden::make('status')->default('Tersedia'),
                Forms\Components\Hidden::make('deskripsi')->default('-'),

                // Fields copied from Master Property
                Forms\Components\Hidden::make('gbr_primary_properti'),
                Forms\Components\Hidden::make('alamat_lengkap'),
                Forms\Components\Hidden::make('provinsi'),
                Forms\Components\Hidden::make('kabupaten'),
                Forms\Components\Hidden::make('kecamatan'),
                Forms\Components\Hidden::make('kelurahan'),
                Forms\Components\Hidden::make('kode_pos'),
                Forms\Components\Hidden::make('luas_tanah'),
                Forms\Components\Hidden::make('luas_bangunan'),
                Forms\Components\Hidden::make('jumlah_kamar_tidur'),
                Forms\Components\Hidden::make('jumlah_kamar_mandi'),
                Forms\Components\Hidden::make('tahun_dibangun'),
                Forms\Components\Hidden::make('latitude'),
                Forms\Components\Hidden::make('longitude'),
            ])->columns(1);
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

                Tables\Columns\TextColumn::make('tersedia_dari')
                    ->label('Tersedia Dari')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tersedia_sampai')
                    ->label('Sampai')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('jumlah_kamar')
                    ->label('Room')
                    ->sortable(),

                Tables\Columns\TextColumn::make('kapasitas_tamu')
                    ->label('Tamu')
                    ->sortable(),

                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR', true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('tahun_dibangun')
                    ->label('Tahun')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('lokasi.nama')
                    ->label('Lokasi')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('jenis_cluster')
                    ->label('Cluster')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('tipe_perumahan')
                    ->label('Tipe')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('jumlah_kamar_tidur')
                    ->label('KT')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('jumlah_kamar_mandi')
                    ->label('KM')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('luas_bangunan')
                    ->label('LB (m²)')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('luas_tanah')
                    ->label('LT (m²)')
                    ->toggleable(isToggledHiddenByDefault: true),

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
            'index' => Pages\ListSewaKosts::route('/'),
            'create' => Pages\CreateSewaKost::route('/create'),
            'edit' => Pages\EditSewaKost::route('/{record}/edit'),
        ];
    }
}
