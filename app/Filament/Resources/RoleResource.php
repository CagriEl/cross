<?php

namespace App\Filament\Resources;

use App\Models\KullaniciIzinleri;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;

class RoleResource extends Resource
{
    protected static ?string $model = KullaniciIzinleri::class;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationLabel = 'Kullanıcı İzinleri';  


    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('rol_adi')
                ->label('Rol Adı')
                ->required(),

            Forms\Components\Toggle::make('cihaz_ekleme')
                ->label('Cihaz Ekleme Yetkisi')
                ->dehydrated(true), // Değişiklikleri kaydet

            Forms\Components\Toggle::make('hastane_ekleme')
                ->label('Hastane Ekleme Yetkisi')
                ->dehydrated(true),

            Forms\Components\Toggle::make('kart_ekleme')
                ->label('Kart Ekleme Yetkisi')
                ->dehydrated(true),

            Forms\Components\Toggle::make('sonuc_ekleme')
                ->label('Sonuç Ekleme Yetkisi')
                ->dehydrated(true),

            Forms\Components\Toggle::make('test_ekleme')
                ->label('Test Ekleme Yetkisi')
                ->dehydrated(true),

            Forms\Components\Toggle::make('kullanici_ekleme')
                ->label('Kullanıcı Ekleme Yetkisi')
                ->dehydrated(true),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('rol_adi')
                    ->label('Rol Adı')
                    ->sortable()
                    ->searchable(),
    
                BadgeColumn::make('cihaz_ekleme')
                    ->label('Cihaz Ekleme')
                    ->getStateUsing(fn ($record) => $record->cihaz_ekleme ? 'Aktif' : 'Pasif')
                    ->colors([
                        'success' => 'Aktif',
                        'danger' => 'Pasif',
                    ]),
    
                BadgeColumn::make('hastane_ekleme')
                    ->label('Hastane Ekleme')
                    ->getStateUsing(fn ($record) => $record->hastane_ekleme ? 'Aktif' : 'Pasif')
                    ->colors([
                        'success' => 'Aktif',
                        'danger' => 'Pasif',
                    ]),
    
                BadgeColumn::make('kart_ekleme')
                    ->label('Kart Ekleme')
                    ->getStateUsing(fn ($record) => $record->kart_ekleme ? 'Aktif' : 'Pasif')
                    ->colors([
                        'success' => 'Aktif',
                        'danger' => 'Pasif',
                    ]),
    
                BadgeColumn::make('sonuc_ekleme')
                    ->label('Sonuç Ekleme')
                    ->getStateUsing(fn ($record) => $record->sonuc_ekleme ? 'Aktif' : 'Pasif')
                    ->colors([
                        'success' => 'Aktif',
                        'danger' => 'Pasif',
                    ]),
    
                BadgeColumn::make('test_ekleme')
                    ->label('Test Ekleme')
                    ->getStateUsing(fn ($record) => $record->test_ekleme ? 'Aktif' : 'Pasif')
                    ->colors([
                        'success' => 'Aktif',
                        'danger' => 'Pasif',
                    ]),
    
                BadgeColumn::make('kullanici_ekleme')
                    ->label('Kullanıcı Ekleme')
                    ->getStateUsing(fn ($record) => $record->kullanici_ekleme ? 'Aktif' : 'Pasif')
                    ->colors([
                        'success' => 'Aktif',
                        'danger' => 'Pasif',
                    ]),
            ]);
    }
    

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\RoleResource\Pages\ListRoles::route('/'),
            'create' => \App\Filament\Resources\RoleResource\Pages\CreateRole::route('/create'),
            'edit' => \App\Filament\Resources\RoleResource\Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
