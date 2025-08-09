<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Informasi;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\InformasiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InformasiResource\RelationManagers;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Support\Str;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;

class InformasiResource extends Resource
{
    protected static ?string $model = Informasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Informasi';
    protected static ?string $pluralLabel = 'Informasi';
    protected static ?string $slug = 'data-informasi';
    protected static ?string $navigationGroup = 'Halaman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Berita')
                    ->description('Untuk menampilkan berita di halaman beranda, aktifkan toggle Show di Beranda? Sedangkan untuk menampilkan gambar slider di halaman beranda, aktifkan toggle Unggulan?')
                    ->schema([
                        TextInput::make('judul')
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
                        RichEditor::make('deskripsi')
                            ->required()
                            ->maxLength(5000)
                            ->columnSpanFull(),
                        Hidden::make('user_id')
                            ->default(fn() => auth()->id())
                            ->dehydrated()
                            ->required(),
                    ])->columns(2),
                Section::make('')
                    ->schema([
                        Toggle::make('unggulan')
                            ->label('Unggulan?')
                            ->inline(false)
                            ->default(false)
                            ->required(),
                        Toggle::make('home')
                            ->inline(false)
                            ->label('Show di Beranda?')
                            ->default(false)
                            ->required(),
                    ])->columns(4),

                FileUpload::make('gambar')
                    ->label('Gambar')
                    ->previewable(true)
                    ->image()
                    ->maxSize(1024)
                    ->maxFiles(1)
                    ->directory('data-informasi')
                    ->openable()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->dehydrated(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->limit(60),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->limit(50),
                Tables\Columns\IconColumn::make('unggulan')
                    ->boolean(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Penulis')
                    ->numeric()
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
            'index' => Pages\ListInformasis::route('/'),
            'create' => Pages\CreateInformasi::route('/create'),
            'edit' => Pages\EditInformasi::route('/{record}/edit'),
        ];
    }
}
