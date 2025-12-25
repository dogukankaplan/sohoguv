<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatResource\Pages;
use App\Models\Stat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StatResource extends Resource
{
    protected static ?string $model = Stat::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'İstatistikler';
    protected static ?string $modelLabel = 'İstatistik';
    protected static ?string $pluralModelLabel = 'İstatistikler';
    protected static ?string $navigationGroup = 'Ana Sayfa Yönetimi';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('icon')
                    ->label('İkon')
                    ->options([
                        'clock' => '⏰ Saat',
                        'check' => '✅ Onay',
                        'users' => '👥 Kullanıcılar',
                        'briefcase' => '💼 Çanta',
                    ])
                    ->helperText('İstatistik için simge seçin'),

                Forms\Components\TextInput::make('value')
                    ->label('Değer')
                    ->required()
                    ->placeholder('15+, 500+, vb.')
                    ->maxLength(20),

                Forms\Components\TextInput::make('label')
                    ->label('Etiket')
                    ->required()
                    ->placeholder('Yıllık Tecrübe, Tamamlanan Proje')
                    ->maxLength(255),

                Forms\Components\TextInput::make('order')
                    ->label('Sıra')
                    ->numeric()
                    ->default(0)
                    ->helperText('Küçük numara önce görünür'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('value')
                    ->label('Değer')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('label')
                    ->label('Etiket')
                    ->searchable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Sıra')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order')
            ->reorderable('order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStats::route('/'),
            'create' => Pages\CreateStat::route('/create'),
            'edit' => Pages\EditStat::route('/{record}/edit'),
        ];
    }
}
