<?php

namespace App\Filament\Resources\HastaneResource\Pages;

use App\Filament\Resources\HastaneResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHastanes extends ListRecords
{
    protected static string $resource = HastaneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
