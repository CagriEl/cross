<?php

namespace App\Filament\Resources\HastaResource\Pages;

use App\Filament\Resources\HastaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHastas extends ListRecords
{
    protected static string $resource = HastaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
