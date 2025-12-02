<?php

namespace App\Filament\Resources;
use App\Filament\Resources\KartResource\RelationManagers\LissResultsRelationManager;


use App\Filament\Resources\KartResource\Pages;
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
                    ->unique(ignoreRecord: true)
                    ->required(),

                Forms\Components\Select::make('test_id')
                    ->label('Test')
                    ->relationship('test', 'test_adi') // Kart modelindeki test() ilişkisi + testler.ad
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kart_numarasi')
                    ->label('Kart Numarası')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('test.test_adi')
                    ->label('Test')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Oluşturulma Tarihi')
                    ->dateTime('d.m.Y H:i'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        LissResultsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListKarts::route('/'),
            'create' => Pages\CreateKart::route('/create'),
            'edit'   => Pages\EditKart::route('/{record}/edit'),
        ];
    }
}
