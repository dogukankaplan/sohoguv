<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerRequestResource\Pages;
use App\Models\CustomerRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerRequestResource extends Resource
{
    protected static ?string $model = CustomerRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationLabel = 'Talepler';
    protected static ?string $modelLabel = 'Talep';
    protected static ?string $pluralModelLabel = 'Talepler';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Talep Türü')
                    ->options([
                        'fault' => 'Arıza Talebi',
                        'inventory' => 'Envanter Talebi',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Ad Soyad / Firma')
                    ->required(),
                Forms\Components\TextInput::make('contact_info')
                    ->label('İletişim Bilgisi')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Durum')
                    ->options([
                        'open' => 'Açık',
                        'processing' => 'İşleniyor',
                        'closed' => 'Kapandı',
                    ])
                    ->default('open')
                    ->required(),
                Forms\Components\Textarea::make('details')
                    ->label('Talep Detayları')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Tür')
                    ->badge()
                    ->colors([
                        'danger' => 'fault',
                        'warning' => 'inventory',
                    ])
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'fault' => 'Arıza',
                        'inventory' => 'Envanter',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('name')
                    ->label('İsim')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_info')
                    ->label('İletişim'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->colors([
                        'success' => 'closed',
                        'warning' => 'processing',
                        'gray' => 'open',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tarih')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'fault' => 'Arıza',
                        'inventory' => 'Envanter',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'open' => 'Açık',
                        'processing' => 'İşleniyor',
                        'closed' => 'Kapandı',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCustomerRequests::route('/'),
            'create' => Pages\CreateCustomerRequest::route('/create'),
            'edit' => Pages\EditCustomerRequest::route('/{record}/edit'),
        ];
    }
}
