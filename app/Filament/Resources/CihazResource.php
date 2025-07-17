<?php

namespace App\Filament\Resources;

use App\Models\Cihaz;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\CihazResource\Pages;
use App\Filament\Resources\CihazResource\RelationManagers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class CihazResource extends Resource
{
    protected static ?string $model = \App\Models\Cihaz::class;
    protected static ?string $pluralModelLabel = 'Cihazlar';
    protected static ?string $modelLabel = 'Cihaz';

    protected static ?string $navigationIcon = 'heroicon-s-printer';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('cihaz_adi')
                ->label('Cihaz Adı')
                ->required(),
            
            Forms\Components\Select::make('hastane_id')
                ->label('Hastane')
                ->relationship('hastane', 'hastane_adi') // Dropdown menü
                ->required()
                ->preload() // Dropdown menüyü doldurmak için tüm verileri önceden yükler
                ->optionsLimit(50)
                ->searchable(), // Arama özelliği
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cihaz_adi')->label('Cihaz Adı')->sortable()->searchable(),
                TextColumn::make('hastane.hastane_adi')->label('Hastane')->sortable()->searchable(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\CihazListe::route('/'),
            'create' => Pages\CreateCihaz::route('/create'),
            'edit' => Pages\EditCihaz::route('/{record}/edit'),
        ];
    }
    public static function getSlug(): string
    {
        return '/cihazlar';
    }

    public static function canView(Model $record): bool
    {
        // Kullanıcı giriş yapmamışsa yetkiyi reddet
        if (!auth()->check()) {
            return false;
        }
    
        // Kullanıcı giriş yaptıysa yetki kontrolü yap
        return auth()->user()->hasPermission('cihaz_ekleme');
    }
    
    public static function canCreate(): bool
    {
        if (!auth()->check()) {
            return false;
        }
    
        return auth()->user()->hasPermission('cihaz_ekleme');
    }
    
    public static function canEdit(Model $record): bool
    {
        if (!auth()->check()) {
            return false;
        }
    
        return auth()->user()->hasPermission('cihaz_ekleme');
    }
    
    public static function canDelete(Model $record): bool
    {
        if (!auth()->check()) {
            return false;
        }
    
        return auth()->user()->hasPermission('cihaz_ekleme');
    }
    
}
 