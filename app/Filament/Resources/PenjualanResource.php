<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Properti;
use Filament\Forms\Form;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Filament\Tables\Table;
use App\Models\MasterWilayah;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\PenjualanResource\Pages;

class PenjualanResource extends Resource
{
    protected static ?string $model = Penjualan::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Proses';
    protected static ?string $navigationLabel = 'Penjualan';
    protected static ?string $pluralModelLabel = 'Penjualan';
    protected static ?string $modelLabel = 'Penjualan';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Identitas Konsumen')
                        ->columns(4)
                        ->schema([
                            Select::make('pelanggan_id')
                                ->label('Pelanggan')
                                ->relationship('pelanggan', 'nama')
                                ->searchable()
                                ->preload()
                                ->live()
                                ->required()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $pelanggan = Pelanggan::find($state);

                                    if ($pelanggan) {
                                        $set('no_ktp', $pelanggan->no_ktp);
                                        $set('telepon', $pelanggan->telepon);
                                        $set('email', $pelanggan->email);
                                        $set('npwp', $pelanggan->npwp);
                                        $set('foto_ktp', $pelanggan->foto_ktp);
                                        $set('foto_npwp', $pelanggan->foto_npwp);
                                    } else {
                                        $set('no_ktp', null);
                                        $set('telepon', null);
                                        $set('email', null);
                                        $set('npwp', null);
                                        $set('foto_ktp', null);
                                        $set('foto_npwp', null);
                                    }
                                }),

                            TextInput::make('no_ktp')
                                ->label('No. Identitas (KTP/SIM)')
                                ->readonly()
                                ->reactive()
                                ->maxLength(255),

                            TextInput::make('telepon')
                                ->label('No HP/WA')
                                ->readonly()
                                ->reactive()
                                ->maxLength(255),

                            TextInput::make('email')
                                ->label('Email')
                                ->readonly()
                                ->reactive()
                                ->email()
                                ->maxLength(255),

                            TextInput::make('npwp')
                                ->label('NPWP')
                                ->readonly()
                                ->reactive()
                                ->maxLength(255),

                            FileUpload::make('foto_ktp')
                                ->label('Foto KTP')
                                ->previewable(true)
                                ->image()
                                ->maxSize(1024)
                                ->maxFiles(1)
                                ->directory('data-pelanggan')
                                ->openable()
                                ->dehydrated(),

                            FileUpload::make('foto_npwp')
                                ->label('Foto NPWP')
                                ->previewable(true)
                                ->image()
                                ->maxSize(1024)
                                ->maxFiles(1)
                                ->directory('data-pelanggan')
                                ->openable()
                                ->dehydrated(),
                        ]),

                    Wizard\Step::make('Identitas Properti')
                        ->columns(5)
                        ->schema([
                            Select::make('properti_id')
                                ->label('Properti')
                                ->relationship('properti', 'judul')
                                ->searchable()
                                ->columnSpan(2)
                                ->preload()
                                ->live()
                                ->required()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $properti = Properti::with('lokasi')->find($state);

                                    if (!$properti || !$properti->lokasi) {
                                        return;
                                    }

                                    // Perbaikan: set ke 'alamat', bukan 'alamat_lengkap'
                                    $set('alamat', $properti->alamat_lengkap);
                                    $set('kode_pos', $properti->kode_pos);

                                    $set('luas_tanah', $properti->luas_tanah);
                                    $set('luas_bangunan', $properti->luas_bangunan);
                                    $set('jumlah_kamar_mandi', $properti->jumlah_kamar_mandi);
                                    $set('jumlah_kamar_tidur', $properti->jumlah_kamar_tidur);
                                    $set('tipe_perumahan', $properti->tipe_perumahan);
                                    $set('jenis_cluster', $properti->jenis_cluster);
                                    $set('harga', $properti->harga);

                                    $kode = $properti->lokasi->kode;
                                    $kodeClean = str_replace('.', '', $kode);

                                    $provinsiKode = substr($kodeClean, 0, 2);
                                    $kabupatenKode = substr($kodeClean, 0, 4);
                                    $kecamatanKode = substr($kodeClean, 0, 6);
                                    $kelurahanKode = $kode;

                                    $provinsi = MasterWilayah::whereRaw("REPLACE(kode, '.', '') = ?", [$provinsiKode])->first()?->nama;
                                    $kabupaten = MasterWilayah::whereRaw("REPLACE(kode, '.', '') = ?", [$kabupatenKode])->first()?->nama;
                                    $kecamatan = MasterWilayah::whereRaw("REPLACE(kode, '.', '') = ?", [$kecamatanKode])->first()?->nama;
                                    $kelurahan = MasterWilayah::where('kode', $kelurahanKode)->first()?->nama;

                                    $set('provinsi', $provinsi);
                                    $set('kabupaten', $kabupaten);
                                    $set('kecamatan', $kecamatan);
                                    $set('kelurahan', $kelurahan);
                                }),

                            TextInput::make('provinsi')
                                ->label('Provinsi')
                                ->readonly()
                                ->columnSpan(1),

                            TextInput::make('kabupaten')
                                ->label('Kabupaten/Kota')
                                ->readonly()
                                ->columnSpan(1),

                            TextInput::make('kecamatan')
                                ->label('Kecamatan')
                                ->readonly()
                                ->columnSpan(1),

                            TextInput::make('kelurahan')
                                ->label('Kelurahan/Desa')
                                ->readonly()
                                ->columnSpan(1),

                            TextInput::make('kode_pos')
                                ->nullable()
                                ->reactive()
                                ->readonly()
                                ->maxLength(10),

                            TextInput::make('alamat')
                                ->label('Alamat Jalan')
                                ->placeholder('Nama Jalan, No. Rumah, RT/RW')
                                ->columnSpan(2)
                                ->readonly()
                                ->reactive()
                                ->nullable(),

                            TextInput::make('jenis_cluster')
                                ->label('Cluster')
                                ->reactive()
                                ->readonly(),

                            TextInput::make('tipe_perumahan')
                                ->label('Tipe')
                                ->reactive()
                                ->readonly(),

                            TextInput::make('jumlah_kamar_tidur')
                                ->label('Kamar Tidur')
                                ->numeric()
                                ->reactive()
                                ->readonly(),

                            TextInput::make('jumlah_kamar_mandi')
                                ->label('Kamar Mandi')
                                ->numeric()
                                ->reactive()
                                ->readonly(),

                            TextInput::make('luas_bangunan')
                                ->label('Luas Bangunan (m²)')
                                ->numeric()
                                ->reactive()
                                ->readonly(),

                            TextInput::make('luas_tanah')
                                ->label('Luas Tanah (m²)')
                                ->numeric()
                                ->reactive()
                                ->readonly(),
                        ]),

                    Wizard\Step::make('Pembayaran')
                        ->columns(5)
                        ->schema([
                            DatePicker::make('tanggal_penjualan')
                                ->native(false)
                                ->required(),

                            TextInput::make('harga')
                                ->label('Harga Properti')
                                ->reactive()
                                ->readonly()
                                ->afterStateHydrated(function ($set, $get) {
                                    $propertiId = $get('properti_id');
                                    if ($propertiId) {
                                        $properti = Properti::find($propertiId);
                                        if ($properti) {
                                            $set('harga', $properti->harga);
                                        }
                                    }
                                })
                                ->numeric(),

                            TextInput::make('harga_jual')
                                ->required()
                                ->numeric(),
                            Select::make('metode_pembayaran')
                                ->label('Metode Pembayaran')
                                ->required()
                                ->options([
                                    'tunai' => 'Tunai',
                                    'transfer' => 'Transfer Bank',
                                    'kredit' => 'Kredit (KPR)',
                                    'cicilan' => 'Cicilan Bertahap',
                                    'leasing' => 'Leasing',
                                    'e-wallet' => 'E-Wallet / Dompet Digital',
                                ])
                                ->searchable()
                                ->native(false),
                            Select::make('status_pembayaran')
                                ->label('Status Pembayaran')
                                ->required()
                                ->options([
                                    'belum_dibayar' => 'Belum Dibayar',
                                    'dp_dibayar' => 'DP Dibayar',
                                    'lunas' => 'Lunas',
                                    'cicil' => 'Sedang Dicicil',
                                    'gagal' => 'Pembayaran Gagal',
                                ])
                                ->native(false),
                            Textarea::make('catatan')
                                ->columnSpanFull(),
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
                TextColumn::make('properti.judul')
                    ->label('Properti')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pembeli.nama')
                    ->label('Pembeli')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('harga_jual')
                    ->label('Harga Penjualan')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                TextColumn::make('tanggal_penjualan')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->badge()
                    ->sortable(),

                TextColumn::make('status_pembayaran')
                    ->label('Status Pembayaran')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'lunas' => 'success',
                        'dp_dibayar', 'cicil' => 'warning',
                        'belum_dibayar' => 'gray',
                        'gagal' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
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
                Tables\Actions\Action::make('print')
                    ->label('Cetak Invoice')
                    ->icon('heroicon-o-printer')
                    ->url(fn($record) => route('invoice.show', ['id' => $record->id]))
                    ->openUrlInNewTab(),

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
            'index' => Pages\ListPenjualans::route('/'),
            'create' => Pages\CreatePenjualan::route('/create'),
            'edit' => Pages\EditPenjualan::route('/{record}/edit'),
            'print' => Pages\InvoicePenjualan::route('/{record}/invoice'),
        ];
    }
}
