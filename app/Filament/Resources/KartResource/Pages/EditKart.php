<?php

namespace App\Filament\Resources\KartResource\Pages;

use App\Filament\Resources\KartResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKart extends EditRecord
{
    protected static string $resource = KartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
