<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SKPrivasiResource\Pages;
use App\Filament\Resources\SKPrivasiResource\RelationManagers;
use App\Models\SKPrivasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SKPrivasiResource extends Resource
{
    protected static ?string $model = SKPrivasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'SK & Privasi';
    protected static ?string $modelLabel = 'SK & Privasi';
    protected static ?string $navigationGroup = 'Halaman';
    protected static ?string $title = 'SK & Privasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'syarat-ketentuan' => 'Syarat & Ketentuan',
                        'kebijakan-privasi' => 'Kebijakan Privasi',
                    ])
                    ->required(),

                Forms\Components\RichEditor::make('isi')
                    ->required()
                    ->maxLength(5000)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->formatStateUsing(
                        fn($state) => $state === 'syarat-ketentuan'
                            ? 'Syarat & Ketentuan'
                            : ($state === 'kebijakan-privasi' ? 'Kebijakan Privasi' : $state)
                    ),
                Tables\Columns\TextColumn::make('isi')
                    ->limit(100),
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
            'index' => Pages\ListSKPrivasis::route('/'),
            'create' => Pages\CreateSKPrivasi::route('/create'),
            'edit' => Pages\EditSKPrivasi::route('/{record}/edit'),
        ];
    }
}
