<?php

namespace App\Filament\Resources\HeroBlockResource\Pages;

use App\Filament\Resources\HeroBlockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHeroBlock extends EditRecord
{
    protected static string $resource = HeroBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
