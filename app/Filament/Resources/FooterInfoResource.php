<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterInfoResource\Pages;
use App\Models\FooterInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class FooterInfoResource extends Resource
{
    protected static ?string $model = FooterInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-chevron-double-down';
    
    protected static ?string $navigationLabel = 'Подвал сайта';
    
    protected static ?string $pluralModelLabel = 'Подвал сайта';
    
    protected static ?string $modelLabel = 'Настройки подвала';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Контактная информация')
                    ->schema([
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->placeholder('dpir-press@mos.ru'),
                            
                        Textarea::make('address')
                            ->label('Адрес')
                            ->rows(3)
                            ->required()
                            ->default('125009, г. Москва, Романов переулок, д. 4 стр. 2'),
                            
                        TextInput::make('privacy_policy_link')
                            ->label('Ссылка на политику конфиденциальности')
                            ->placeholder('#'),
                            
                        TextInput::make('newsletter_link')
                            ->label('Ссылка на подписку')
                            ->placeholder('#'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')->label('Email'),
                TextColumn::make('address')->label('Адрес')->limit(30),
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
            'index' => Pages\ListFooterInfos::route('/'),
            'create' => Pages\CreateFooterInfo::route('/create'),
            'edit' => Pages\EditFooterInfo::route('/{record}/edit'),
        ];
    }
}