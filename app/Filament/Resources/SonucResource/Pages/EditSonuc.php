<?php

namespace App\Filament\Resources\SonucResource\Pages;

use App\Filament\Resources\SonucResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSonuc extends EditRecord
{
    protected static string $resource = SonucResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
