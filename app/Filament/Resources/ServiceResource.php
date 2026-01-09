<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Hizmetler';
    protected static ?string $modelLabel = 'Hizmet';
    protected static ?string $pluralModelLabel = 'Hizmetler';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        // Main Content (2 Columns)
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('İçerik Bilgileri')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Başlık')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('slug')
                                            ->label('URL Yolu (Slug)')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->helperText('Bu alan otomatik oluşturulur, ancak manuel olarak düzenleyebilirsiniz.')
                                            ->columnSpanFull(),

                                        Forms\Components\Textarea::make('content')
                                            ->label('İçerik')
                                            ->rows(10)
                                            ->columnSpanFull(),
                                    ]),
                            ])
                            ->columnSpan(['lg' => 2]),

                        // Sidebar (1 Column)
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Medya')
                                    ->schema([
                                        Forms\Components\FileUpload::make('image')
                                            ->label('Kapak Görseli')
                                            ->image()
                                            ->directory('services')
                                            ->disk('public')
                                            ->maxSize(5120)
                                            ->columnSpanFull()
                                            ->imageEditor(),
                                    ]),

                                Forms\Components\Section::make('SEO Ayarları')
                                    ->schema([
                                        Forms\Components\TextInput::make('seo_title')
                                            ->label('SEO Başlığı')
                                            ->placeholder('Google arama sonuçlarında görünecek başlık'),

                                        Forms\Components\Textarea::make('seo_description')
                                            ->label('SEO Açıklaması')
                                            ->rows(3)
                                            ->placeholder('Sayfa içeriğini özetleyen kısa açıklama'),
                                    ]),

                                Forms\Components\Section::make('Görünürlük')
                                    ->schema([
                                        Forms\Components\Placeholder::make('created_at')
                                            ->label('Oluşturulma Tarihi')
                                            ->content(fn($record) => $record?->created_at?->diffForHumans() ?? '-'),

                                        Forms\Components\Placeholder::make('updated_at')
                                            ->label('Son Güncelleme')
                                            ->content(fn($record) => $record?->updated_at?->diffForHumans() ?? '-'),
                                    ])
                                    ->hidden(fn($record) => $record === null),
                            ])
                            ->columnSpan(['lg' => 1]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Görsel'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma Tarihi')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
