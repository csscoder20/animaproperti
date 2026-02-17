<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Riwayat Sewa';
    protected static ?string $modelLabel = 'Riwayat Sewa';
    protected static ?string $pluralModelLabel = 'Riwayat Sewa';
    protected static ?string $navigationGroup = 'Proses';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Penyewa')
                    ->schema([
                        Forms\Components\TextInput::make('customer_name')
                            ->label('Nama Penyewa')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('customer_phone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('room_number')
                            ->label('Nomor Kamar')
                            ->placeholder('Contoh: A-101')
                            ->maxLength(255),
                    ])->columns(3),

                Forms\Components\Section::make('Detail Sewa')
                    ->schema([
                        Forms\Components\Select::make('properti_id')
                            ->label('Properti')
                            ->relationship('properti', 'judul')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('agent_id')
                            ->label('Agen')
                            ->relationship('agent', 'nama_lengkap')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\DatePicker::make('checkin')
                            ->label('Tanggal Check-in')
                            ->required(),
                        Forms\Components\DatePicker::make('checkout')
                            ->label('Tanggal Check-out')
                            ->required(),
                        Forms\Components\TextInput::make('duration')
                            ->label('Durasi (Malam)')
                            ->numeric()
                            ->required()
                            ->minValue(1),
                        Forms\Components\TextInput::make('rooms')
                            ->label('Jumlah Kamar')
                            ->numeric()
                            ->required()
                            ->minValue(1),
                        Forms\Components\TextInput::make('guests')
                            ->label('Jumlah Tamu')
                            ->numeric()
                            ->required()
                            ->minValue(1),
                        Forms\Components\TextInput::make('total_price')
                            ->label('Total Harga')
                            ->prefix('Rp')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->label('Status Pesanan')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'paid' => 'Dibayar',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                                'refunded' => 'Dikembalikan',
                            ])
                            ->required()
                            ->native(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Booking')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama Penyewa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_phone')
                    ->label('No. HP')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('properti.judul')
                    ->label('Properti')
                    ->limit(30)
                    ->searchable(),
                Tables\Columns\TextColumn::make('agent.nama_lengkap')
                    ->label('Agen')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('checkin')
                    ->date('d M Y'),
                Tables\Columns\TextColumn::make('checkout')
                    ->date('d M Y'),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Durasi')
                    ->suffix(' Malam'),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode Bayar')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'primary',
                        'paid' => 'success',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        'refunded' => 'danger',
                        default => 'gray',
                    })
                    ->action(
                        Tables\Actions\Action::make('update_status')
                            ->label('Update Status')
                            ->form([
                                Forms\Components\Select::make('status')
                                    ->label('Status Baru')
                                    ->options([
                                        'pending' => 'Pending',
                                        'confirmed' => 'Confirmed',
                                        'paid' => 'Dibayar',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                        'refunded' => 'Dikembalikan',
                                    ])
                                    ->required()
                                    ->default(fn (Booking $record) => $record->status),
                            ])
                            ->modalHeading('Update Status Pesanan')
                            ->modalDescription('Apakah Anda yakin ingin mengubah status pesanan ini? Stok kamar akan disesuaikan otomatis.')
                            ->modalSubmitActionLabel('Simpan')
                            ->action(function (Booking $record, array $data) {
                                $record->update($data);
                            })
                            ->requiresConfirmation()
                    )
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('print_invoice')
                        ->label('Cetak Invoice')
                        ->icon('heroicon-o-printer')
                        ->color('success')
                        ->visible(fn (Booking $record) => in_array($record->status, ['paid', 'completed']))
                        ->url(fn(Booking $record): string => route('admin.bookings.print-invoice', $record))
                        ->openUrlInNewTab(),
                    Tables\Actions\Action::make('print_room_card')
                        ->label('Cetak Kartu Kamar')
                        ->icon('heroicon-o-identification')
                        ->color('info')
                        ->visible(fn (Booking $record) => in_array($record->status, ['paid', 'completed']))
                        ->url(fn(Booking $record): string => route('admin.bookings.print-room-card', $record))
                        ->openUrlInNewTab(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBookings::route('/'),
        ];
    }
}
