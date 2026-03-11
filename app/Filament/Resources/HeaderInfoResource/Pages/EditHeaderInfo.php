<?php

namespace App\Filament\Resources\HeaderInfoResource\Pages;

use App\Filament\Resources\HeaderInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHeaderInfo extends EditRecord
{
    protected static string $resource = HeaderInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
