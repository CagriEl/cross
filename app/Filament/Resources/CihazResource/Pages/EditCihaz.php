<?php

namespace App\Filament\Resources\CihazResource\Pages;

use App\Filament\Resources\CihazResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCihaz extends EditRecord
{
    protected static string $resource = CihazResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
