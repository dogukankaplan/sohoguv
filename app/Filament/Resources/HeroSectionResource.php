<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSectionResource\Pages;
use App\Models\HeroSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HeroSectionResource extends Resource
{
    protected static ?string $model = HeroSection::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Hero Bölümleri';
    protected static ?string $modelLabel = 'Hero Bölümü';
    protected static ?string $pluralModelLabel = 'Hero Bölümleri';
    protected static ?string $navigationGroup = 'Ana Sayfa Yönetimi';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Genel Ayarlar')
                    ->description('Hero bölümünün temel içerik ayarları')
                    ->schema([
                        Forms\Components\Select::make('page')
                            ->label('Sayfa')
                            ->options([
                                'home' => 'Ana Sayfa',
                                'about' => 'Hakkımızda',
                                'contact' => 'İletişim',
                                'references' => 'Referanslar',
                            ])
                            ->required()
                            ->default('home'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('Sadece bir hero her sayfa için aktif olmalı. Aktif olduğunda bu hero bölümü seçilen sayfada gösterilir.'),
                    ])->columns(2),

                Forms\Components\Section::make('Metin İçeriği')
                    ->schema([
                        Forms\Components\TextInput::make('badge_text')
                            ->label('Rozet Yazısı (Üstteki küçük yazı)')
                            ->placeholder('Örn: Türkiye\'nin Güvenilir Güvenlik Çözümü')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('title')
                            ->label('Ana Başlık')
                            ->required()
                            ->placeholder('Örn: Güvenliğiniz Bizim Önceliğimiz')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('subtitle')
                            ->label('Alt Başlık')
                            ->rows(3)
                            ->placeholder('Örn: SOHO Güvenlik Sistemleri olarak, kurumsal altyapınızı en üst düzeyde koruyoruz...')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Butonlar')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('cta_text')
                            ->label('Birinci Buton Yazısı (Primary)')
                            ->placeholder('Örn: Keşfetmeye Başla')
                            ->maxLength(100),

                        Forms\Components\TextInput::make('cta_url')
                            ->label('Birinci Buton URL')
                            ->placeholder('Örn: #services veya /contact')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('cta_secondary_text')
                            ->label('İkinci Buton Yazısı (Outline)')
                            ->placeholder('Örn: Bize Ulaşın')
                            ->maxLength(100),

                        Forms\Components\TextInput::make('cta_secondary_url')
                            ->label('İkinci Buton URL')
                            ->placeholder('Örn: /contact')
                            ->maxLength(255),
                    ]),

                Forms\Components\Section::make('Görsel Elemanlar')
                    ->schema([
                        Forms\Components\FileUpload::make('background_image')
                            ->label('Arkaplan Görseli (Opsiyonel)')
                            ->image()
                            ->directory('hero-backgrounds')
                            ->helperText('Yüklerseniz animasyonlu arkaplan yerine bu görsel kullanılır.'),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('trust_indicator_1')
                                    ->label('Güven Rozeti 1')
                                    ->placeholder('Örn: 5.0 Müşteri Memnuniyeti')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('trust_indicator_2')
                                    ->label('Güven Rozeti 2')
                                    ->placeholder('Örn: ISO 9001 Sertifikalı')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('trust_indicator_3')
                                    ->label('Güven Rozeti 3')
                                    ->placeholder('Örn: 7/24 Teknik Destek')
                                    ->maxLength(255),
                            ]),
                    ]),

                Forms\Components\Section::make('Sağ Taraf - Dashboard Mockup Verileri')
                    ->collapsible()
                    ->collapsed()
                    ->description('Ana sayfa sağ taraftaki görsel mockup üzerindeki verileri özelleştirin.')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('stat_1_value')
                                    ->label('İstatistik 1 Değer')
                                    ->placeholder('Örn: 24')
                                    ->default('24'),
                                Forms\Components\TextInput::make('stat_1_label')
                                    ->label('İstatistik 1 Etiket')
                                    ->placeholder('Örn: Aktif Kamera')
                                    ->default('Aktif Kamera'),

                                Forms\Components\TextInput::make('stat_2_value')
                                    ->label('İstatistik 2 Değer')
                                    ->placeholder('Örn: 100%')
                                    ->default('100%'),
                                Forms\Components\TextInput::make('stat_2_label')
                                    ->label('İstatistik 2 Etiket')
                                    ->placeholder('Örn: Sistem Sağlığı')
                                    ->default('Sistem Sağlığı'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page')
                    ->label('Sayfa')
                    ->badge(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->limit(40),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Güncellenme')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
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
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroSections::route('/'),
            'create' => Pages\CreateHeroSection::route('/create'),
            'edit' => Pages\EditHeroSection::route('/{record}/edit'),
        ];
    }
}
