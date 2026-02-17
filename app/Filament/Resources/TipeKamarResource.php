<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipeKamarResource\Pages;
use App\Filament\Resources\TipeKamarResource\RelationManagers;
use App\Models\TipeKamar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipeKamarResource extends Resource
{
    protected static ?string $model = TipeKamar::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $navigationLabel = 'Tipe Kamar';
    protected static ?string $pluralModelLabel = 'Tipe Kamar';
    protected static ?string $modelLabel = 'Tipe Kamar';
    protected static ?string $slug = 'data-tipe-kamar';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Tipe Kamar')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('harga_per_malam')
                            ->label('Harga per Malam')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),
                        Forms\Components\TextInput::make('jumlah_kamar')
                            ->label('Jumlah Kamar')
                            ->numeric()
                            ->default(1)
                            ->required(),
                    ])->columns(3),

                Forms\Components\Section::make('Kapasitas & Ketersediaan')
                    ->schema([
                        Forms\Components\TextInput::make('kapasitas_dewasa')
                            ->label('Max Dewasa')
                            ->numeric()
                            ->default(2)
                            ->required(),
                        Forms\Components\TextInput::make('kapasitas_anak')
                            ->label('Max Anak')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Forms\Components\DatePicker::make('tersedia_dari')
                            ->label('Tersedia Dari')
                            ->native(false)
                            ->displayFormat('d M Y'),
                        Forms\Components\DatePicker::make('tersedia_sampai')
                            ->label('Tersedia Sampai')
                            ->native(false)
                            ->displayFormat('d M Y'),
                    ])->columns(4),

                Forms\Components\Section::make('Spesifikasi & Gambar')
                    ->schema([
                        Forms\Components\TextInput::make('luas_kamar')
                            ->label('Luas Kamar (m²)')
                            ->placeholder('Contoh: 20'),
                        Forms\Components\TextInput::make('tipe_bed')
                            ->label('Tipe Bed')
                            ->placeholder('Contoh: King Size'),
                        Forms\Components\FileUpload::make('gambar')
                            ->label('Foto Kamar')
                            ->image()
                            ->directory('tipe-kamar-images')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Fasilitas')
                    ->schema([
                        Forms\Components\CheckboxList::make('fasilitas')
                            ->label('Fasilitas Kamar')
                            ->relationship('fasilitas', 'nama')
                            ->columns(4)
                            ->gridDirection('row')
                            ->bulkToggleable()
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Tipe Kamar')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_kamar')
                    ->label('Jumlah Kamar')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_per_malam')
                    ->label('Harga per Malam')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kapasitas_dewasa')
                    ->label('Kapasitas Dewasa')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kapasitas_anak')
                    ->label('Kapasitas Anak')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_kamar')
                    ->label('Luas Kamar')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipe_bed')
                    ->label('Tipe Bed')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tersedia_dari')
                    ->label('Tersedia Dari')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tersedia_sampai')
                    ->label('Tersedia Sampai')
                    ->date()
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
            'index' => Pages\ListTipeKamars::route('/'),
            'create' => Pages\CreateTipeKamar::route('/create'),
            'edit' => Pages\EditTipeKamar::route('/{record}/edit'),
        ];
    }
}
