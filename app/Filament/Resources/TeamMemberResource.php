<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationLabel = 'Сотрудники';
    
    protected static ?string $pluralModelLabel = 'Сотрудники';
    
    protected static ?string $modelLabel = 'Сотрудник';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Информация о сотруднике')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Фотография')
                            ->image()
                            ->directory('team')
                            ->disk('public')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull(),
                            
                        TextInput::make('name')
                            ->label('ФИО')
                            ->required()
                            ->maxLength(255),
                            
                        TextInput::make('position')
                            ->label('Должность')
                            ->required()
                            ->maxLength(255),
                            
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
                    ->circular()
                    ->size(50),
                TextColumn::make('name')->label('Имя')->searchable(),
                TextColumn::make('position')->label('Должность')->searchable(),
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
            'index' => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit' => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}