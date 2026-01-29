<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HastaResource\Pages;
use App\Models\Hasta;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;

class HastaResource extends Resource
{
    protected static ?string $model = Hasta::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Hasta / Donör Kaydı'; 




    // 🟢 Filament’in model adını değiştirelim
    public static function getModelLabel(): string
    {
        return 'Hasta / Donör Kaydı';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Hasta / Donör Kaydı';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ad')
                    ->label('Ad')
                    ->required(),
                    
                Forms\Components\TextInput::make('soyad')
                    ->label('Soyad')
                    ->required(),
                    
                Select::make('kan_grubu')
                    ->label('Kan Grubu')
                    ->options([
                        'A+' => 'A+',
                        'A-' => 'A-',
                        'B+' => 'B+',
                        'B-' => 'B-',
                        'AB+' => 'AB+',
                        'AB-' => 'AB-',
                        'O+' => 'O+',
                        'O-' => 'O-',
                    ])
                    ->required(),

                Select::make('aciliyet_derecesi')
                    ->label('Aciliyet Derecesi')
                    ->options([
                        'kritik' => 'Kritik',
                        'acil' => 'Acil',
                        'normal' => 'Normal',
                    ])
                    ->default('normal')
                    ->required(),

                Select::make('kayit_tipi')
                    ->label('Hasta/Donör Kaydı')
                    ->options([
                        'hasta' => 'Hasta',
                        'donor' => 'Donör',
                    ])
                    ->default('hasta')
                    ->required(),

                Select::make('hastane_id')
                    ->label('Hastane')
                    ->relationship('hastane', 'hastane_adi')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ad')->label('Ad')->sortable()->searchable(),
                TextColumn::make('soyad')->label('Soyad')->sortable()->searchable(),
                TextColumn::make('kan_grubu')->label('Kan Grubu'),
                TextColumn::make('aciliyet_derecesi')->label('Aciliyet Derecesi'),
                TextColumn::make('kayit_tipi')->label('Kayıt Tipi'),
                TextColumn::make('hastane.hastane_adi')->label('Hastane'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHastas::route('/'),
            'create' => Pages\CreateHasta::route('/create'),
            'edit' => Pages\EditHasta::route('/{record}/edit'),
        ];
    }
}
