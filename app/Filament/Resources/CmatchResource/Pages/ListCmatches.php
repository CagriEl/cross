<?php

namespace App\Filament\Resources\CmatchResource\Pages;

use App\Filament\Resources\CmatchResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Pages\Actions\CreateAction;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ListCmatches extends ListRecords
{
    protected static string $resource = CmatchResource::class;

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('file_1_name')->label('1. Dosya'),
            TextColumn::make('file_2_name')->label('2. Dosya'),
            TextColumn::make('matched_records')
                ->label('Eşleşen Kayıtlar')
                ->wrap()
                ->formatStateUsing(fn (?string $state): string => collect(json_decode($state ?? '[]', true))->implode("\n")),
            TextColumn::make('created_at')
                ->label('Yükleme Tarihi')
                ->dateTime('d M Y H:i'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('details')
                ->label('Detay')
                ->icon('heroicon-o-eye')
                ->modalHeading('Eşleşme Detayları')
                ->modalWidth('5xl')
                ->modalContentView('filament.components.matches-detail', ['record' => '{record}']),

            EditAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
