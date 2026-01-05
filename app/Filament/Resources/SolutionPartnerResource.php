<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SolutionPartnerResource\Pages;
use App\Models\SolutionPartner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SolutionPartnerResource extends Resource
{
    protected static ?string $model = SolutionPartner::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?string $navigationLabel = 'Çözüm Ortakları';

    protected static ?string $modelLabel = 'Çözüm Ortağı';

    protected static ?string $pluralModelLabel = 'Çözüm Ortakları';

    protected static ?string $navigationParentItem = 'Referanslar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Firma Adı')
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->directory('solution-partners')
                    ->disk('public')
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),

                Forms\Components\TextInput::make('website')
                    ->label('Website URL')
                    ->url()
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
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Firma Adı')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('website')
                    ->label('Website')
                    ->url(fn($record) => $record->website)
                    ->openUrlInNewTab()
                    ->limit(30),

                Tables\Columns\TextColumn::make('order')
                    ->label('Sıra')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Aktiflik Durumu'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSolutionPartners::route('/'),
            'create' => Pages\CreateSolutionPartner::route('/create'),
            'edit' => Pages\EditSolutionPartner::route('/{record}/edit'),
        ];
    }
}
