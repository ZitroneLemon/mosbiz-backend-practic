<?php

namespace App\Filament\Resources\SubordinateStructureResource\Pages;

use App\Filament\Resources\SubordinateStructureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubordinateStructures extends ListRecords
{
    protected static string $resource = SubordinateStructureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
