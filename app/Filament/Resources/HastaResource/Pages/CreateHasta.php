<?php

namespace App\Filament\Resources\HastaResource\Pages;

use App\Filament\Resources\HastaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHasta extends CreateRecord
{
    protected static string $resource = HastaResource::class;

    // 🟢 Sayfanın başlığını değiştirelim
    protected static ?string $title = 'Hasta / Donör Kaydı';
}
