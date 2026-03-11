<?php

namespace App\Filament\Resources\FooterInfoResource\Pages;

use App\Filament\Resources\FooterInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFooterInfo extends EditRecord
{
    protected static string $resource = FooterInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
