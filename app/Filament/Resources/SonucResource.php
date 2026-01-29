<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SonucResource\Pages;
use App\Filament\Resources\SonucResource\RelationManagers;
use App\Models\Sonuc;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class SonucResource extends Resource
{
    protected static ?string $model = Sonuc::class;
    protected static ?string $pluralModelLabel = 'Sonuçlar';
    protected static ?string $modelLabel = 'Sonuc';
    protected static ?string $navigationIcon = 'heroicon-c-document-plus';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kart_id')
                    ->label('Kart')
                    ->relationship('kart', 'kart_numarasi')
                    ->required()
                    ->preload(),

                Forms\Components\Select::make('test_id')
                    ->label('Test')
                    ->relationship('test', 'test_adi')
                    ->required()
                    ->preload(),

                Forms\Components\TextInput::make('sonuc')
                    ->label('Sonuç')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kart.kart_numarasi')->label('Kart Numarası')->sortable()->searchable(),
                TextColumn::make('test.test_adi')->label('Test Adı')->sortable()->searchable(),
                TextColumn::make('sonuc')->label('Sonuç')->sortable(),
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
            'index' => Pages\ListSonucs::route('/'),
            'create' => Pages\CreateSonuc::route('/create'),
            'edit' => Pages\EditSonuc::route('/{record}/edit'),
        ];
    }
}
