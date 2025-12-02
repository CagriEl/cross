<?php

namespace App\Filament\Resources\KartResource\RelationManagers;

use App\Models\LissResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class LissResultsRelationManager extends RelationManager
{
    protected static string $relationship = 'lissResults'; // Kart modelindeki ilişki adı

    protected static ?string $title = 'Cihaz Sonuçları (LISS)';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sonuc_siparis_no')
                    ->label('Sonuç Sipariş No')
                    ->maxLength(255),

                Forms\Components\TextInput::make('test_id_raw')
                    ->label('Test ID (Ham)')
                    ->maxLength(255),

                Forms\Components\TextInput::make('cardlis_id')
                    ->label('CardLis ID')
                    ->maxLength(255),

                Forms\Components\TextInput::make('test_name')
                    ->label('Test Adı')
                    ->maxLength(255),

                Forms\Components\Textarea::make('sonuc_ham')
                    ->label('Sonuç (Ham LISS String)')
                    ->rows(3),

                Forms\Components\TextInput::make('normallik')
                    ->label('Normallik')
                    ->maxLength(1),

                Forms\Components\TextInput::make('sonuc_tipi')
                    ->label('Sonuç Tipi')
                    ->maxLength(1),

                Forms\Components\TextInput::make('operator')
                    ->label('Operator')
                    ->maxLength(255),

                Forms\Components\DateTimePicker::make('test_baslama')
                    ->label('Test Başlama'),

                Forms\Components\DateTimePicker::make('test_bitis')
                    ->label('Test Bitiş'),

                Forms\Components\TextInput::make('device_name')
                    ->label('Cihaz Adı')
                    ->maxLength(255),

                Forms\Components\TextInput::make('device_serial')
                    ->label('Cihaz Seri No')
                    ->maxLength(255),

                Forms\Components\TextInput::make('device_software_version')
                    ->label('Yazılım Versiyonu')
                    ->maxLength(255),

                Forms\Components\TextInput::make('pic_name')
                    ->label('Resim Adı')
                    ->maxLength(255),

                Forms\Components\TextInput::make('pic_length')
                    ->label('Resim Uzunluğu')
                    ->numeric(),

                Forms\Components\Textarea::make('pic_info')
                    ->label('Resim Bilgisi')
                    ->rows(2),

                Forms\Components\Textarea::make('raw_line')
                    ->label('Ham R Satırı')
                    ->rows(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sonuc_siparis_no')
                    ->label('Sipariş No')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('test_name')
                    ->label('Test Adı')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('normallik')
                    ->label('N')
                    ->sortable(),

                Tables\Columns\TextColumn::make('sonuc_tipi')
                    ->label('Tip')
                    ->sortable(),

                Tables\Columns\TextColumn::make('operator')
                    ->label('Operator'),

                Tables\Columns\TextColumn::make('test_baslama')
                    ->label('Başlama')
                    ->dateTime('d.m.Y H:i'),

                Tables\Columns\TextColumn::make('test_bitis')
                    ->label('Bitiş')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Yeni Cihaz Sonucu Ekle'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
