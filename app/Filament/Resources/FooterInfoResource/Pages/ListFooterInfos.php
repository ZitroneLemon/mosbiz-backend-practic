<?php

namespace App\Filament\Resources\FooterInfoResource\Pages;

use App\Filament\Resources\FooterInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFooterInfos extends ListRecords
{
    protected static string $resource = FooterInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}