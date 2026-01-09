<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Models\Section;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Site Yönetimi';
    protected static ?string $navigationLabel = 'Ana Sayfa Bölümleri';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Bölüm Ayarları')
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->label('Bölüm Tipi')
                            ->options([
                                'hero' => 'Hero (Manşet)',
                                'stats' => 'İstatistikler',
                                'services' => 'Hizmetler',
                                'features' => 'Özellikler',
                                'video' => 'Tanıtım Videosu',
                                'clients' => 'Referanslar',
                                'partners' => 'Partnerler',
                                'solution_partners' => 'Çözüm Ortakları',
                                'testimonials' => 'Müşteri Yorumları',
                                'cta' => 'CTA (Çağrı Alanı)',
                                'custom' => 'Özel İçerik',
                            ])
                            ->required()
                            ->reactive(),

                        Forms\Components\TextInput::make('title')
                            ->label('Başlık')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('subtitle')
                            ->label('Alt Başlık / Slogan')
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('image')
                            ->label(fn(Forms\Get $get) => $get('type') === 'video' ? 'Video Kapak Görseli (Opsiyonel)' : 'Görsel')
                            ->image()
                            ->directory('sections')
                            ->disk('public')
                            ->directory('sections')
                            ->disk('public')
                            ->maxSize(5120),

                        Forms\Components\FileUpload::make('settings.bg_image')
                            ->label('Arka Plan Görseli (Opsiyonel)')
                            ->image()
                            ->directory('backgrounds')
                            ->disk('public')
                            ->maxSize(10240) // Allow larger for BG
                            ->visible(fn(Forms\Get $get) => in_array($get('type'), ['hero', 'cta', 'video'])),

                        Forms\Components\Textarea::make('content')
                            ->label(fn(Forms\Get $get) => $get('type') === 'video' ? 'Youtube Video Linki' : 'İçerik')
                            ->helperText(fn(Forms\Get $get) => $get('type') === 'video' ? 'Buraya Youtube video linkini yapıştırın (Örn: https://www.youtube.com/watch?v=dQw4w9WgXcQ). Sistem otomatik olarak algılayacaktır.' : null)
                            ->visible(fn(Forms\Get $get) => $get('type') === 'video' || $get('type') === 'custom')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('content_rich')
                            ->label('İçerik')
                            ->rows(10)
                            ->hidden(fn(Forms\Get $get) => $get('type') === 'video')
                            ->visible(fn(Forms\Get $get) => $get('type') === 'custom')
                            ->columnSpanFull(),

                        Forms\Components\ColorPicker::make('bg_color')
                            ->label('Arka Plan Rengi'),

                        Forms\Components\TextInput::make('order')
                            ->label('Sıralama')
                            ->numeric()
                            ->default(0),

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
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tip')
                    ->badge()
                    ->colors([
                        'primary' => 'hero',
                        'success' => 'services',
                        'warning' => 'stats',
                    ]),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
                Tables\Columns\TextInputColumn::make('order')
                    ->label('Sıra')
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
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
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
        ];
    }
}
