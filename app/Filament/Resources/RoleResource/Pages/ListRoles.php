<?php

namespace App\Filament\Resources\RoleResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions\CreateAction;
use App\Filament\Resources\RoleResource;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(), // Ekleme butonunu etkinleştir
        ];
    }
}
