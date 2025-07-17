<?php

namespace App\Filament\Resources\HastaResource\Pages;

use App\Filament\Resources\HastaResource;
use Filament\Resources\Pages\EditRecord;

class EditHasta extends EditRecord
{
    protected static string $resource = HastaResource::class;

    // 🟢 Düzenleme sayfasının başlığını değiştirelim
    protected static ?string $title = 'Hasta / Donör Düzenleme';
}
