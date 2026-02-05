<?php

namespace App\Filament\Resources\CmatchResource\Pages;

use App\Filament\Resources\CmatchResource;
use Filament\Resources\Pages\ListRecords;

class ListCmatches extends ListRecords
{
    protected static string $resource = CmatchResource::class;

    // Excel ve Widget ile ilgili her şeyi sildik. 
    // Sadece tertemiz, standart bir Filament listesi kaldı.

    protected function getHeaderActions(): array
    {
        return [
            // İstersen buradan manuel giriş butonu bırakabilirsin
        ];
    }
}