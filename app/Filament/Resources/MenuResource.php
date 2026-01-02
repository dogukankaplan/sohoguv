<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';
    protected static ?string $navigationGroup = 'Site Yönetimi';
    protected static ?string $navigationLabel = 'Menü Yönetimi';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Menü Öğesi Detayları')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Başlık')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('location')
                            ->label('Konum')
                            ->options([
                                'header' => 'Header (Üst Menü)',
                                'footer_1' => 'Footer Kolon 1',
                                'footer_2' => 'Footer Kolon 2',
                            ])
                            ->default('header')
                            ->required(),

                        Forms\Components\Select::make('parent_id')
                            ->label('Üst Menü (Dropdown)')
                            ->options(Menu::whereNull('parent_id')->pluck('title', 'id'))
                            ->searchable()
                            ->preload(),

                        Forms\Components\TextInput::make('url')
                            ->label('URL (Harici Link)')
                            ->placeholder('https://...'),

                        Forms\Components\TextInput::make('route')
                            ->label('Route Adı (Dahili Link)')
                            ->placeholder('home, contact, services.index'),

                        Forms\Components\TextInput::make('order')
                            ->label('Sıralama')
                            ->numeric()
                            ->default(0),

                        Forms\Components\Toggle::make('new_tab')
                            ->label('Yeni Sekmede Aç'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif mi?')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Konum')
                    ->badge(),
                Tables\Columns\TextColumn::make('parent.title')
                    ->label('Üst Menü')
                    ->placeholder('-'),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
                Tables\Columns\TextInputColumn::make('order')
                    ->label('Sıra')
                    ->sortable(),
            ])
            ->defaultSort('location', 'asc')
            ->defaultGroup('location') // Gruplandırma özelliği
            ->filters([
                Tables\Filters\SelectFilter::make('location')
                    ->options([
                        'header' => 'Header',
                        'footer_1' => 'Footer 1',
                        'footer_2' => 'Footer 2',
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
