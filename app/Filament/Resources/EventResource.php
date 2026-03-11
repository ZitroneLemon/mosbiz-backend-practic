<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    
    protected static ?string $navigationLabel = 'Мероприятия';
    
    protected static ?string $pluralModelLabel = 'Мероприятия';
    
    protected static ?string $modelLabel = 'Мероприятие';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Фотография мероприятия')
                            ->image()
                            ->directory('events')
                            ->disk('public')
                            ->visibility('public')
                            ->imageEditor()
                            ->imagePreviewHeight('200')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(5120)
                            ->helperText('Загрузите фото с компьютера (JPEG, PNG, до 5МБ)')
                            ->columnSpanFull(),
                            
                        TextInput::make('title')
                            ->label('Название мероприятия')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Введите название мероприятия'),
                            
                        Textarea::make('description')
                            ->label('Описание')
                            ->rows(5)
                            ->required()
                            ->placeholder('Введите подробное описание мероприятия')
                            ->columnSpanFull(),
                    ])->columns(2),
                    
                Forms\Components\Section::make('Даты и тип')
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('Дата начала')
                            ->required()
                            ->displayFormat('d.m.Y')
                            ->placeholder('Выберите дату'),
                            
                        DatePicker::make('end_date')
                            ->label('Дата окончания')
                            ->displayFormat('d.m.Y')
                            ->afterOrEqual('start_date')
                            ->placeholder('Выберите дату (если есть)'),
                            
                        Select::make('type')
                            ->label('Тип мероприятия')
                            ->options([
                                'innovation' => 'Инновации',
                                'export' => 'Экспорт',
                                'entrepreneurship' => 'Предпринимательство',
                                'human_capital' => 'Человеческий капитал',
                                'other' => 'Другое',
                            ])
                            ->placeholder('Выберите тип'),
                    ])->columns(3),
                    
                Forms\Components\Section::make('Настройки отображения')
                    ->schema([
                        TextInput::make('order')
                            ->label('Порядок сортировки')
                            ->numeric()
                            ->default(0)
                            ->helperText('Меньшее число = выше в списке'),
                            
                        Toggle::make('is_active')
                            ->label('Активно')
                            ->default(true)
                            ->helperText('Отключите, чтобы скрыть мероприятие с сайта'),
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
                    ->size(60)
                    ->defaultImageUrl(url('/images/no-image.png'))
                    ->extraAttributes(['class' => 'cursor-pointer']),
                    
                TextColumn::make('title')
                    ->label('Название')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                    
                TextColumn::make('start_date')
                    ->label('Дата начала')
                    ->date('d.m.Y')
                    ->sortable(),
                    
                TextColumn::make('end_date')
                    ->label('Дата окончания')
                    ->date('d.m.Y')
                    ->placeholder('—'),
                    
                TextColumn::make('type')
                    ->label('Тип')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'innovation' => 'success',
                        'export' => 'warning',
                        'entrepreneurship' => 'info',
                        'human_capital' => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'innovation' => '🚀 Инновации',
                        'export' => '🌍 Экспорт',
                        'entrepreneurship' => '💼 Предпринимательство',
                        'human_capital' => '👥 Человеческий капитал',
                        'other' => '📌 Другое',
                        default => $state,
                    }),
                    
                IconColumn::make('is_active')
                    ->label('Активно')
                    ->boolean()
                    ->sortable(),
                    
                TextColumn::make('order')
                    ->label('Порядок')
                    ->sortable()
                    ->alignCenter(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Тип мероприятия')
                    ->options([
                        'innovation' => 'Инновации',
                        'export' => 'Экспорт',
                        'entrepreneurship' => 'Предпринимательство',
                        'human_capital' => 'Человеческий капитал',
                        'other' => 'Другое',
                    ]),
                    
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активность')
                    ->placeholder('Все мероприятия')
                    ->trueLabel('Активные')
                    ->falseLabel('Неактивные'),
                    
                Tables\Filters\Filter::make('start_date')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('С даты'),
                        DatePicker::make('created_until')
                            ->label('По дату'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'], fn ($q) => $q->where('start_date', '>=', $data['created_from']))
                            ->when($data['created_until'], fn ($q) => $q->where('start_date', '<=', $data['created_until']));
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Редактировать')
                    ->icon('heroicon-o-pencil'),
                Tables\Actions\DeleteAction::make()
                    ->label('Удалить')
                    ->icon('heroicon-o-trash'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Удалить выбранные'),
                ]),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->striped();
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}