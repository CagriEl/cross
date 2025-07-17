<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KartResource\Pages;
use App\Filament\Resources\KartResource\RelationManagers;
use App\Models\Kart;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class KartResource extends Resource
{
    protected static ?string $model = Kart::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kart_numarasi')
                    ->label('Kart Numarası')
                    ->unique()
                    ->required(),

                Forms\Components\Select::make('tip')
                    ->label('Kart Tipi')
                    ->options([
                        'Hasta' => 'Hasta',
                        'Donör' => 'Donör',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kart_numarasi')->label('Kart Numarası')->sortable()->searchable(),
                TextColumn::make('tip')->label('Kart Tipi')->sortable(),
                TextColumn::make('created_at')->label('Oluşturulma Tarihi')->date(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKarts::route('/'),
            'create' => Pages\CreateKart::route('/create'),
            'edit' => Pages\EditKart::route('/{record}/edit'),
        ];
    }
}
