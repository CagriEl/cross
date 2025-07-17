<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\UserResource;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Create butonunu burada tanımlıyoruz
            \Filament\Pages\Actions\CreateAction::make(),
        ];
    }
    protected function getTableActions(): array
{
    return [
        Tables\Actions\EditAction::make(), // Düzenleme
        Tables\Actions\DeleteAction::make(), // Silme
    ];
}

}
