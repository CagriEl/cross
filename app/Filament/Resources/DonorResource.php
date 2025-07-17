<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonorResource\Pages;
use App\Filament\Resources\DonorResource\RelationManagers;
use App\Models\Donor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use App\Models\HastaDonorMatch;



class DonorResource extends Resource
{
    protected static ?string $model = Donor::class;
    

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    


    // 🟢 Filament’in model adını değiştirelim
    public static function getModelLabel(): string
    {
        return 'Donör';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Donörler';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('donor_file')
                    ->label('Donör Listesi (Excel)')
                    ->disk('local')
                    ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
public static function getTableActions(): array
{
    return [
        Action::make('importExcel')
            ->label('Excel Yükle')
            ->modalHeading('Excel Dosyası Yükle')
            ->modalSubheading('Lütfen bir Excel (.xlsx) dosyası seçin ve yükleyin.')
            ->modalButton('Yükle')
            ->form([
                Forms\Components\FileUpload::make('donor_file')
                    ->label('Donör Excel Dosyası')
                    ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
                    ->required(),
            ])
            ->action(function (array $data) {
                $file = $data['donor_file'];
                $rows = Excel::toArray([], $file)[0];

                foreach ($rows as $row) {
                    if (!isset($row['Ad Soyad']) || empty(trim($row['Ad Soyad']))) {
                        continue;
                    }

                    $fullName = explode(' ', trim($row['Ad Soyad']));
                    $ad = $fullName[0] ?? 'Bilinmeyen';
                    $soyad = isset($fullName[1]) ? implode(' ', array_slice($fullName, 1)) : 'Bilinmeyen';

                    if (empty($row['Kan Grubu'])) {
                        continue;
                    }

                    $donor = Donor::create([
                        'ad' => $ad,
                        'soyad' => $soyad,
                        'kan_grubu' => $row['Kan Grubu'],
                        'son_kullanma_tarihi' => Carbon::now()->addDays(40)->toDateString(),
                    ]);

                    // 🟢 Hasta ile eşleşen donörleri hasta_donor_matches tablosuna kaydet
                    $hastalar = Hasta::where('kan_grubu', $donor->kan_grubu)->get();
                    foreach ($hastalar as $hasta) {
                        HastaDonorMatch::create([
                            'hasta_id' => $hasta->id,
                            'donor_id' => $donor->id,
                        ]);
                    }
                }
            })
            ->successNotificationTitle('Donörler başarıyla yüklendi!'),
    ];
}

    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonors::route('/'),
            'create' => Pages\CreateDonor::route('/create'),
            'edit' => Pages\EditDonor::route('/{record}/edit'),
        ];
    }
}
