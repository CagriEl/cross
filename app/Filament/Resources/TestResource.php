<?php

namespace App\Filament\Resources;

use App\Models\Test;

use App\Filament\Resources\TestResource\Pages;
use App\Filament\Resources\TestResource\RelationManagers;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;
    protected static ?string $pluralModelLabel = 'Testler';
    protected static ?string $modelLabel = 'Test';
    protected static ?string $navigationIcon = 'heroicon-o-h3';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('test_adi')
                    ->label('Test Adı')
                    ->required(),

                    Forms\Components\Select::make('cihaz_id')
                    ->label('Cihaz')
                    ->relationship('cihaz', 'cihaz_adi') // Test modelindeki cihaz ilişkisinden verileri çeker
                    ->required()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('test_adi')->label('Test Adı')->sortable()->searchable(),
                TextColumn::make('cihaz.cihaz_adi')->label('Cihaz')->sortable()->searchable(),
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
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}
