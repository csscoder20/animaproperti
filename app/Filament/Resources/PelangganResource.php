<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pelanggan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\PelangganResource\Pages;

class PelangganResource extends Resource
{
    protected static ?string $model = Pelanggan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationLabel = 'Pelanggan';
    protected static ?string $pluralLabel = 'Pelanggan';
    protected static ?string $slug = 'data-pelanggan';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_ktp')
                    ->label('No. KTP')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('npwp')
                    ->label('No. NPWP')
                    ->maxLength(255),
                Forms\Components\TextInput::make('telepon')
                    ->label('No. HP/WA')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pekerjaan')
                    ->label('Pekerjaan')
                    ->maxLength(255),
                Forms\Components\Textarea::make('alamat')
                    ->label('Alamat')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('foto_ktp')
                    ->label('Foto KTP')
                    ->previewable(true)
                    ->image()
                    ->maxSize(1024)
                    ->maxFiles(1)
                    ->directory('data-pelanggan')
                    ->openable()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->dehydrated(),

                FileUpload::make('foto_npwp')
                    ->label('Foto NPWP')
                    ->previewable(true)
                    ->image()
                    ->maxSize(1024)
                    ->maxFiles(1)
                    ->directory('data-pelanggan')
                    ->openable()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->dehydrated(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Lengkap')
                    ->searchable(),

                TextColumn::make('no_ktp')
                    ->label('No. KTP')
                    ->searchable(),

                TextColumn::make('npwp')
                    ->label('No. NPWP')
                    ->searchable(),

                TextColumn::make('telepon')
                    ->label('No. HP/WA')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('pekerjaan')
                    ->label('Pekerjaan')
                    ->searchable(),

                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(30)
                    ->searchable(),

                Tables\Columns\ImageColumn::make('foto_ktp')
                    ->label('Foto KTP')
                    ->disk('public')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->height(40)
                    ->defaultImageUrl(asset('themes/frontend/assets/img/default.png')),

                Tables\Columns\ImageColumn::make('foto_npwp')
                    ->label('Foto NPWP')
                    ->disk('public')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->height(40)
                    ->defaultImageUrl(asset('themes/frontend/assets/img/default.png')),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diubah')
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
            'index' => Pages\ListPelanggans::route('/'),
            'create' => Pages\CreatePelanggan::route('/create'),
            'edit' => Pages\EditPelanggan::route('/{record}/edit'),
        ];
    }
}
