<?php

namespace App\Filament\Resources\KartResource\Pages;

use App\Filament\Resources\KartResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKarts extends ListRecords
{
    protected static string $resource = KartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
