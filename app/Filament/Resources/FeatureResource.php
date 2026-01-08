<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureResource\Pages;
use App\Models\Feature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Özellikler';
    protected static ?string $modelLabel = 'Özellik';
    protected static ?string $pluralModelLabel = 'Özellikler';
    protected static ?string $navigationGroup = 'Ana Sayfa Yönetimi';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('section')
                    ->label('Bölüm')
                    ->options([
                        'why_soho' => 'Neden SOHO? (Üst)',
                        'why_us' => 'Neden Biz? (Alt)',
                    ])
                    ->required()
                    ->helperText('Bu özelliğin hangi bölümde gösterileceğini seçin'),

                Forms\Components\Select::make('icon')
                    ->label('İkon')
                    ->options([
                        'users' => '👥 Kullanıcılar',
                        'phone' => '📞 Telefon',
                        'shield' => '🛡️ Kalkan',
                        'screen' => '💻 Ekran',
                        'lock' => '🔒 Kilit',
                        'badge' => '✅ Rozet',
                    ]),

                Forms\Components\TextInput::make('title')
                    ->label('Başlık')
                    ->required()
                    ->maxLength(255),

                Forms\Components\RichEditor::make('description')
                    ->label('Açıklama')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('order')
                    ->label('Sıra')
                    ->numeric()
                    ->default(0),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section')
                    ->label('Bölüm')
                    ->badge()
                    ->color(fn($state) => $state === 'why_soho' ? 'success' : 'info')
                    ->formatStateUsing(fn($state) => $state === 'why_soho' ? 'Neden SOHO' : 'Neden Biz'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Sıra')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('section')
                    ->label('Bölüm')
                    ->options([
                        'why_soho' => 'Neden SOHO',
                        'why_us' => 'Neden Biz',
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
            ])
            ->defaultSort('order')
            ->reorderable('order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeature::route('/create'),
            'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
