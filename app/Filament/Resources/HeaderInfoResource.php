<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeaderInfoResource\Pages;
use App\Models\HeaderInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class HeaderInfoResource extends Resource
{
    protected static ?string $model = HeaderInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-chevron-double-up';
    
    protected static ?string $navigationLabel = 'Шапка сайта';
    
    protected static ?string $pluralModelLabel = 'Шапка сайта';
    
    protected static ?string $modelLabel = 'Настройки шапки';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Контактная информация')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Телефон')
                            ->required()
                            ->placeholder('+7 (499) 444-16-15'),
                            
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->placeholder('dpir-press@mos.ru'),
                            
                        TextInput::make('feedback_link')
                            ->label('Ссылка "Написать нам"')
                            ->placeholder('#'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('phone')->label('Телефон'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('feedback_link')->label('Ссылка'),
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
            'index' => Pages\ListHeaderInfos::route('/'),
            'create' => Pages\CreateHeaderInfo::route('/create'),
            'edit' => Pages\EditHeaderInfo::route('/{record}/edit'),
        ];
    }
}