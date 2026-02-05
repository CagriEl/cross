<?php

namespace App\Filament\Widgets;

use App\Models\Cmatch;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ManualMatchesTable extends BaseWidget
{
    protected static ?string $heading = 'Otomatik Hasta & Donör Eşleşmeleri';
    
    protected int | string | array $columnSpan = 'full'; // Tam genişlik

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Cmatch::query()->where('source', 'manual') // Sadece manuel/otomatik olanlar
            )
            ->columns([
                Tables\Columns\TextColumn::make('hasta.ad_soyad')
                    ->label('Hasta')
                    ->state(fn ($record) => $record->hasta->ad . ' ' . $record->hasta->soyad)
                    ->description(fn ($record) => "Kan: " . $record->hasta->kan_grubu),
                
                Tables\Columns\TextColumn::make('donor.ad_soyad')
                    ->label('Eşleşen Donör')
                    ->state(fn ($record) => $record->donor->ad . ' ' . $record->donor->soyad)
                    ->description(fn ($record) => "Kan: " . $record->donor->kan_grubu),

                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->color(fn ($state) => $state === 'approved' ? 'success' : 'warning'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Eşleşme Tarihi')
                    ->dateTime('d.m.Y H:i'),
            ]);
    }
}