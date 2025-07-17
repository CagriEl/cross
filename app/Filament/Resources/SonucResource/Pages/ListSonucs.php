<?php

namespace App\Filament\Resources\SonucResource\Pages;

use App\Filament\Resources\SonucResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSonucs extends ListRecords
{
    protected static string $resource = SonucResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
