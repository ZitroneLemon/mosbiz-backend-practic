<?php

namespace App\Filament\Resources\HeroBlockResource\Pages;

use App\Filament\Resources\HeroBlockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHeroBlocks extends ListRecords
{
    protected static string $resource = HeroBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
