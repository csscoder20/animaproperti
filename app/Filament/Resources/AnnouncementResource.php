<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnouncementResource\Pages;
use App\Models\Announcement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Fieldset;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;
    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    protected static ?string $navigationLabel = 'Info';
    protected static ?string $modelLabel = 'Info';
    protected static ?string $navigationGroup = 'Halaman';
    protected static ?string $title = 'Info';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Detail Info')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('type')
                            ->options([
                                'Info' => 'Info',
                                'Promo' => 'Promo',
                                'Lelang' => 'Lelang',
                                'Iklan' => 'Iklan',
                                'Karir' => 'Karir',
                            ]),
                        Forms\Components\DatePicker::make('start_date')
                            ->default(true)
                            ->native(false)
                            ->seconds(false)
                            ->displayFormat('d/m/Y')
                            ->default(now())
                            ->required(),
                        Forms\Components\DatePicker::make('end_date')
                            ->default(true)
                            ->native(false)
                            ->seconds(false)
                            ->displayFormat('d/m/Y')
                            ->default(now())
                            ->required(),
                    ])->columns(2),
                Fieldset::make('Deskripsi dan Gambar')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->columnSpan(2),
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Gambar')
                            ->previewable(true)
                            ->image()
                            ->maxSize(1024)
                            ->maxFiles(1)
                            ->directory('info')
                            ->openable()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->dehydrated(),
                    ])->columns(3),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
                Forms\Components\Toggle::make('show_once_per_session')
                    ->label('Tampilkan hanya sekali per sesi?')
                    ->default(true),
            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\BadgeColumn::make('type'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('start_date')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->dateTime(),
                Tables\Columns\TextColumn::make('end_date')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->dateTime(),
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
            'index' => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'edit' => Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }
}
