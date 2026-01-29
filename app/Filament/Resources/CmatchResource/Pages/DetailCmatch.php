<?php
// File: app/Filament/Resources/CmatchResource/Pages/DetailCmatch.php

namespace App\Filament\Resources\CmatchResource\Pages;

use App\Filament\Resources\CmatchResource;
use App\Models\Cmatch;
use Filament\Resources\Pages\Page;

class DetailCmatch extends Page
{
    protected static string $resource = CmatchResource::class;
    protected static string $view     = 'filament.resources.cmatch-resource.pages.detail-cmatch';

    public Cmatch $record;

    public function mount($record): void
    {
        $this->record = Cmatch::findOrFail($record);
    }
}
