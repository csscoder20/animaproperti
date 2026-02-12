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
    protected static ?string $navigationGroup = 'Manajemen Sewa';

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
                    ])->columns(2),

                Forms\Components\Section::make('Detail Sewa')
                    ->schema([
                        Forms\Components\Select::make('properti_id')
                            ->label('Properti')
                            ->relationship('properti', 'judul')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\DatePicker::make('checkin')
                            ->label('Tanggal Check-in')
                            ->required(),
                        Forms\Components\TextInput::make('duration')
                            ->label('Durasi (Malam)')
                            ->numeric()
                            ->required()
                            ->minValue(1),
                        Forms\Components\TextInput::make('total_price')
                            ->label('Total Harga')
                            ->prefix('Rp')
                            ->numeric()
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Status Pesanan')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'cancelled' => 'Cancelled',
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('properti.judul')
                    ->label('Properti')
                    ->limit(30)
                    ->searchable(),
                Tables\Columns\TextColumn::make('agent.nama_lengkap')
                    ->label('Agen')
                    ->sortable(),
                Tables\Columns\TextColumn::make('checkin')
                    ->date('d M Y'),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Durasi')
                    ->suffix(' Malam'),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
