<?php 

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationLabel = 'Kullanıcılar'; 
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('Ad Soyad')->required(),
                Forms\Components\TextInput::make('phone')->label('Telefon'),
                Forms\Components\Select::make('role_id')
                ->label('Rol')
                ->relationship('role', 'rol_adi') // İlişkiyi kontrol edin
                ->required()
                ->preload(),
                
                Forms\Components\Select::make('hastane_id')
                ->label('Hastane')
                ->relationship('hastane', 'hastane_adi') // İlişki adı ve görüntülenecek sütun
                ->required()
                ->preload(),
                
                Forms\Components\TextInput::make('email')->label('E-Posta')->email()->required(),
                Forms\Components\TextInput::make('password')
    ->label('Şifre')
    ->password()
    ->dehydrated(fn ($state) => !empty($state)) // Şifre sadece doldurulmuşsa kaydedilir
    ->dehydrateStateUsing(fn ($state) => bcrypt($state)) // Şifreyi Bcrypt ile hashler
    ->nullable() // Şifre boş bırakılabilir
    ->hiddenOn('index') // Liste ekranında gizle
    ->helperText('Şifreyi değiştirmek için yeni bir şifre girin.'),

            ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    TextColumn::make('name')
                        ->label('Ad Soyad')
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('phone')
                        ->label('Telefon'),
                    TextColumn::make('role.rol_adi') // Rol bilgisi
                        ->label('Rol')
                        ->sortable()
                        ->searchable(),
                        TextColumn::make('hastane.hastane_adi')
                        ->label('Hastane')
                        ->sortable()
                        ->searchable()
                        ->default('Hastane Yok'), // Eğer ilişki null ise 'Hastane Yok' gösterir
                    
                    TextColumn::make('email')
                        ->label('E-Posta'),

                        
                ]);
        }
        
    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
{
    return [
        'index' => \App\Filament\Resources\UserResource\Pages\ListUsers::route('/'),
        'create' => \App\Filament\Resources\UserResource\Pages\CreateUser::route('/create'),
        'edit' => \App\Filament\Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
    ];
}

protected function getTableActions(): array
{
    return [
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make()
            ->before(function (Model $record) {
                if ($record->role->rol_adi === 'Admin') {
                    throw new \Exception('Admin kullanıcılar silinemez!');
                }
            }),
    ];
}



    
}
