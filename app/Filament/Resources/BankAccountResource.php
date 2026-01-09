<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankAccountResource\Pages;
use App\Filament\Resources\BankAccountResource\RelationManagers;
use App\Models\BankAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankAccountResource extends Resource
{
    protected static ?string $model = BankAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Banka Bilgileri')
                    ->schema([
                        Forms\Components\TextInput::make('bank_name')
                            ->label('Banka Adı')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('branch_name')
                            ->label('Şube Adı')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('account_holder')
                            ->label('Hesap Sahibi')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('iban')
                            ->label('IBAN')
                            ->required()
                            ->maxLength(34),
                        Forms\Components\TextInput::make('swift_code')
                            ->label('SWIFT Kodu')
                            ->maxLength(255),
                        Forms\Components\Select::make('currency')
                            ->label('Para Birimi')
                            ->options([
                                'TL' => 'TL',
                                'USD' => 'USD',
                                'EUR' => 'EUR',
                            ])
                            ->default('TL')
                            ->required(),
                        Forms\Components\FileUpload::make('logo')
                            ->label('Banka Logosu')
                            ->image()
                            ->directory('banks'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        Forms\Components\TextInput::make('order')
                            ->label('Sıralama')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo'),
                Tables\Columns\TextColumn::make('bank_name')
                    ->label('Banka')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('account_holder')
                    ->label('Hesap Sahibi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('iban')
                    ->label('IBAN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency')
                    ->label('Döviz')
                    ->badge(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
                Tables\Columns\TextColumn::make('order')
                    ->label('Sıralama')
                    ->sortable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBankAccounts::route('/'),
            'create' => Pages\CreateBankAccount::route('/create'),
            'edit' => Pages\EditBankAccount::route('/{record}/edit'),
        ];
    }
}
