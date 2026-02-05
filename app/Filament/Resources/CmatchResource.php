<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CmatchResource\Pages;
use App\Models\Cmatch;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CmatchResource extends Resource
{
    protected static ?string $model = Cmatch::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';
    protected static ?string $navigationLabel = 'Otomatik Eşleşmeler';

    public static function table(Table $table): Table
    {
        return $table
            // SADECE MANUEL/OTOMATİK KAYITLARI GETİR
            ->modifyQueryUsing(fn (Builder $query) => $query->where('source', 'manual')->latest())
            ->columns([
                Tables\Columns\TextColumn::make('hasta.ad_soyad')
                    ->label('Hasta')
                    ->state(fn ($record) => $record->hasta ? "{$record->hasta->ad} {$record->hasta->soyad}" : 'Kayıt Silinmiş')
                    ->description(fn ($record) => $record->hasta ? "Kan: {$record->hasta->kan_grubu}" : null)
                    ->searchable(['ad', 'soyad']),

                Tables\Columns\TextColumn::make('donor.ad_soyad')
                    ->label('Eşleşen Donör')
                    ->state(fn ($record) => $record->donor ? "{$record->donor->ad} {$record->donor->soyad}" : 'Kayıt Silinmiş')
                    ->description(fn ($record) => $record->donor ? "Kan: {$record->donor->kan_grubu}" : null)
                    ->searchable(['ad', 'soyad']),

                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => $state === 'pending' ? 'Beklemede' : 'Onaylandı'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Eşleşme Tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Onayla')
                    ->icon('heroicon-m-check-badge')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(fn ($record) => $record->update(['status' => 'approved'])),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCmatches::route('/'),
        ];
    }
}