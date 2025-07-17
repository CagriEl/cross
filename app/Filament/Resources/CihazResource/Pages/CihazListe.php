<?php

namespace App\Filament\Resources\CihazResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

use App\Filament\Resources\CihazResource;

class CihazListe extends ListRecords
{
    protected static string $resource = CihazResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}


