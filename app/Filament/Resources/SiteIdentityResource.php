<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteIdentityResource\Pages;
use App\Models\SiteIdentity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteIdentityResource extends Resource
{
    protected static ?string $model = SiteIdentity::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Site Kimliği & Logo';
    protected static ?string $modelLabel = 'Site Kimliği';
    protected static ?string $navigationGroup = 'Sistem';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Site Kimliği')
                    ->description('Site başlığı, logo ve favicon ayarları.')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->label('Site Başlığı')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('logo')
                            ->label('Site Logosu')
                            ->image()
                            ->directory('site-identity')
                            ->disk('public')
                            ->maxSize(5120)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('favicon')
                            ->label('Favicon')
                            ->image()
                            ->directory('site-identity')
                            ->disk('public')
                            ->maxSize(1024)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site_name')
                    ->label('Site Başlığı')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo'),
                Tables\Columns\ImageColumn::make('favicon')
                    ->label('Favicon'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Güncellenme')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Single record enforce usually means no bulk actions needed
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteIdentities::route('/'),
            'create' => Pages\CreateSiteIdentity::route('/create'),
            'edit' => Pages\EditSiteIdentity::route('/{record}/edit'),
        ];
    }
}
