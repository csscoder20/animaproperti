<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisPropertiResource\Pages;
use App\Models\JenisProperti;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Str;

class JenisPropertiResource extends Resource
{
    protected static ?string $model = JenisProperti::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $navigationLabel = 'Jenis Properti';
    protected static ?string $pluralLabel = 'Jenis Properti';
    protected static ?string $slug = 'jenis-properti';
    protected static ?string $navigationGroup = 'Master Data';


    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Jenis')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(100)
                    ->unique(ignoreRecord: true),
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->maxLength(500)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->label('Slug')->sortable(),
                Tables\Columns\TextColumn::make('deskripsi')->label('Deskripsi')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->dateTime()->sortable(),
            ])
            ->filters([
                //
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

                        $newNama = $record->nama . ' (Copy)';
                        $newRecord->nama = $newNama;

                        $newRecord->slug = Str::slug($newNama) . '-' . Str::random(4);

                        $newRecord->save();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Duplicate Item')
                    ->modalSubheading('Apakah Anda yakin ingin menduplikasi item ini?')
                    ->modalButton('Ya, Duplikasi'),
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
            // Contoh: RelationManagers\PropertiRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJenisPropertis::route('/'),
            'create' => Pages\CreateJenisProperti::route('/create'),
            'edit' => Pages\EditJenisProperti::route('/{record}/edit'),
        ];
    }
}
