<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Slider';
    protected static ?string $modelLabel = 'Slider';
    protected static ?string $navigationGroup = 'Halaman';
    protected static ?string $title = 'Slider';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Detail Slider')
                    ->description('Upload gambar slider dengan ukuran yang sama. Jika slider ingin diarahkan ke halaman tertentu, masukkan URL pada field yang tersedia.')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('link_url')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('order')
                            ->label('Urutan')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\DatePicker::make('start_date')
                            ->native(false)
                            ->seconds(false)
                            ->displayFormat('d/m/Y')
                            ->default(now())
                            ->required()
                            ->before('end_date')
                            ->label('Start Date'),

                        Forms\Components\DatePicker::make('end_date')
                            ->native(false)
                            ->seconds(false)
                            ->displayFormat('d/m/Y')
                            ->default(now())
                            ->required()
                            ->after('start_date')
                            ->label('End Date'),

                    ])->columns(3),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif?')
                    ->default(true)
                    ->columnSpanFull()
                    ->hidden(fn($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),

                Forms\Components\FileUpload::make('image_path')
                    ->image()
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
                    ])
                    ->dehydrated()
                    ->required(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
