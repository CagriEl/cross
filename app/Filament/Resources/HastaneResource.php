<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HastaneResource\Pages;
use App\Filament\Resources\HastaneResource\RelationManagers;
use App\Models\Hastane;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class HastaneResource extends Resource
{
    protected static ?string $model = Hastane::class;
    protected static ?string $pluralModelLabel = 'Hastaneler';
    protected static ?string $modelLabel = 'Hastane';
    protected static ?string $navigationIcon = 'heroicon-s-building-library';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('hastane_adi')->required(),
            Forms\Components\TextInput::make('hastane_adres')->required(),
        ]);
}
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hastane_adi')->sortable()->searchable(),
                TextColumn::make('hastane_adres')->sortable()->searchable(),
                TextColumn::make('created_at')->label('Oluşturulma Tarihi')->date(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHastanes::route('/'),
            'create' => Pages\CreateHastane::route('/create'),
            'edit' => Pages\EditHastane::route('/{record}/edit'),
        ];
    }
    public static function getSlug(): string
{
    return '/hastaneler';
}
}
