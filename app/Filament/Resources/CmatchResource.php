<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CmatchResource\Pages;
use App\Models\Cmatch;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;       // genel Action
use Filament\Tables\Actions\ViewAction;   // Detay butonu
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class CmatchResource extends Resource
{

    protected static ?string $model = Cmatch::class;
    protected static ?string $pluralModelLabel = 'Eşleştirme';
    protected static ?string $modelLabel = 'Eşleme';
    protected static ?string $navigationIcon = 'heroicon-arrows-right-left';


    public static function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('file_1')
                ->label('1. Excel Dosyası')
                ->required()
                ->disk('local')
                ->directory('cmatches')
                ->preserveFilenames()
                ->storeFileNamesIn('file_1_name'),
            FileUpload::make('file_2')
                ->label('2. Excel Dosyası')
                ->required()
                ->disk('local')
                ->directory('cmatches')
                ->preserveFilenames()
                ->storeFileNamesIn('file_2_name'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('file_1_name')->label('1. Dosya'),
                TextColumn::make('file_2_name')->label('2. Dosya'),
                TextColumn::make('created_at')
                    ->label('Yükleme Tarihi')
                    ->dateTime('d M Y H:i'),
            ])
            ->actions([
                ViewAction::make()   // Detay (view) sayfasına taşır
                    ->label('Detay')
                    ->icon('heroicon-o-eye'),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->headerActions([
                Action::make('create')
                    ->label('Excel Karşılaştır')
                    ->icon('heroicon-o-document-text')
                    ->url(fn(): string => static::getUrl('create')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCmatches::route('/'),
            'create' => Pages\CreateCmatch::route('/create'),
            'edit'   => Pages\EditCmatch::route('/{record}/edit'),
            'view'   => Pages\ViewCmatch::route('/{record}/view'),
        ];
    }
}
