<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
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

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';
    
    protected static ?string $navigationLabel = 'Проекты';
    
    protected static ?string $pluralModelLabel = 'Проекты';
    
    protected static ?string $modelLabel = 'Проект';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Информация о проекте')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Изображение')
                            ->image()
                            ->directory('projects')
                            ->disk('public')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull(),
                            
                        TextInput::make('title')
                            ->label('Название проекта')
                            ->required()
                            ->maxLength(255),
                            
                        Textarea::make('description')
                            ->label('Описание')
                            ->rows(4)
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}