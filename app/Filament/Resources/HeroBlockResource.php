<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroBlockResource\Pages;
use App\Models\HeroBlock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class HeroBlockResource extends Resource
{
    protected static ?string $model = HeroBlock::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static ?string $navigationLabel = 'Главный блок';
    
    protected static ?string $pluralModelLabel = 'Главный блок';
    
    protected static ?string $modelLabel = 'Главный блок';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')
                    ->schema([
                        TextInput::make('main_title')
                            ->label('Главный заголовок')
                            ->required()
                            ->columnSpanFull(),
                            
                        TextInput::make('bottom_title')
                            ->label('Подзаголовок')
                            ->required(),
                            
                        FileUpload::make('background_image')
                            ->label('Фоновое изображение')
                            ->image()
                            ->directory('hero')
                            ->disk('public')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ]),
                    
                Forms\Components\Section::make('Статистика')
                    ->schema([
                        TextInput::make('stat_1_value')
                            ->label('Значение 1')
                            ->required()
                            ->placeholder('105 млрд ₽'),
                        TextInput::make('stat_1_label')
                            ->label('Подпись 1')
                            ->required()
                            ->placeholder('Направлено на поддержку'),
                            
                        TextInput::make('stat_2_value')
                            ->label('Значение 2')
                            ->required()
                            ->placeholder('1 млн'),
                        TextInput::make('stat_2_label')
                            ->label('Подпись 2')
                            ->required()
                            ->placeholder('Оказанных услуг'),
                            
                        TextInput::make('stat_3_value')
                            ->label('Значение 3')
                            ->required()
                            ->placeholder('250 000'),
                        TextInput::make('stat_3_label')
                            ->label('Подпись 3')
                            ->required()
                            ->placeholder('Поддержанных предпринимателей'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('background_image')
                    ->label('Фон')
                    ->size(50)
                    ->circular(),
                TextColumn::make('main_title')->label('Заголовок')->limit(30),
                TextColumn::make('updated_at')->label('Обновлено')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroBlocks::route('/'),
            'create' => Pages\CreateHeroBlock::route('/create'),
            'edit' => Pages\EditHeroBlock::route('/{record}/edit'),
        ];
    }
}