<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubordinateStructureResource\Pages;
use App\Models\SubordinateStructure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class SubordinateStructureResource extends Resource
{
    protected static ?string $model = SubordinateStructure::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    
    protected static ?string $navigationLabel = 'Подведомственные структуры';
    
    protected static ?string $pluralModelLabel = 'Подведомственные структуры';
    
    protected static ?string $modelLabel = 'Структура';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Информация о структуре')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Логотип или фото')
                            ->image()
                            ->directory('structures')
                            ->disk('public')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull(),
                            
                        TextInput::make('title')
                            ->label('Название')
                            ->required()
                            ->maxLength(255),
                            
                        Textarea::make('description')
                            ->label('Описание')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),
                            
                        TextInput::make('link')
                            ->label('Ссылка')
                            ->placeholder('#'),
                            
                        TextInput::make('link_text')
                            ->label('Текст ссылки')
                            ->default('Подробнее'),
                            
                        TextInput::make('order')
                            ->label('Порядок сортировки')
                            ->numeric()
                            ->default(0),
                            
                        Toggle::make('is_active')
                            ->label('Активно')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Фото')
                    ->size(50),
                TextColumn::make('title')->label('Название')->searchable(),
                TextColumn::make('description')->label('Описание')->limit(30),
                IconColumn::make('is_active')->label('Активно')->boolean(),
                TextColumn::make('order')->label('Порядок')->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubordinateStructures::route('/'),
            'create' => Pages\CreateSubordinateStructure::route('/create'),
            'edit' => Pages\EditSubordinateStructure::route('/{record}/edit'),
        ];
    }
}