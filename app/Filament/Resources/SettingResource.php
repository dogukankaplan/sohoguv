<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Site Ayarları';
    protected static ?string $modelLabel = 'Ayar';
    protected static ?string $pluralModelLabel = 'Ayarlar';
    protected static ?string $navigationGroup = 'Sistem';
    protected static ?int $navigationSort = 99;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([
                        // Site Bilgileri
                        Forms\Components\Tabs\Tab::make('Site Bilgileri')
                            ->schema([
                                Forms\Components\TextInput::make('site_name')
                                    ->label('Site Adı')
                                    ->default('SOHO Güvenlik Sistemleri')
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('site_tagline')
                                    ->label('Site Sloganı')
                                    ->default('Güvenliği Sanata Dönüştürüyoruz')
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('logo')
                                    ->label('Site Logosu')
                                    ->image()
                                    ->directory('settings')
                                    ->imageEditor(),

                                Forms\Components\FileUpload::make('favicon')
                                    ->label('Favicon')
                                    ->image()
                                    ->directory('settings'),
                            ]),

                        // İletişim
                        Forms\Components\Tabs\Tab::make('İletişim')
                            ->schema([
                                Forms\Components\TextInput::make('phone')
                                    ->label('Telefon')
                                    ->tel()
                                    ->default('+90 (555) 123 45 67'),

                                Forms\Components\TextInput::make('phone_2')
                                    ->label('Telefon 2')
                                    ->tel(),

                                Forms\Components\TextInput::make('email')
                                    ->label('E-posta')
                                    ->email()
                                    ->default('info@sohoguvenlik.com'),

                                Forms\Components\TextInput::make('email_2')
                                    ->label('E-posta 2')
                                    ->email(),

                                Forms\Components\Textarea::make('address')
                                    ->label('Adres')
                                    ->default('İstanbul, Türkiye')
                                    ->rows(2)
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('working_hours')
                                    ->label('Çalışma Saatleri')
                                    ->default('Pzt-Cum 09:00-18:00')
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('maps_embed')
                                    ->label('Google Maps Embed Kodu')
                                    ->placeholder('<iframe src="..."></iframe>')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),

                        // Sosyal Medya
                        Forms\Components\Tabs\Tab::make('Sosyal Medya')
                            ->schema([
                                Forms\Components\TextInput::make('facebook')
                                    ->label('Facebook')
                                    ->url()
                                    ->prefix('https://'),

                                Forms\Components\TextInput::make('instagram')
                                    ->label('Instagram')
                                    ->url()
                                    ->prefix('https://'),

                                Forms\Components\TextInput::make('linkedin')
                                    ->label('LinkedIn')
                                    ->url()
                                    ->prefix('https://'),

                                Forms\Components\TextInput::make('twitter')
                                    ->label('Twitter/X')
                                    ->url()
                                    ->prefix('https://'),

                                Forms\Components\TextInput::make('youtube')
                                    ->label('YouTube')
                                    ->url()
                                    ->prefix('https://'),

                                Forms\Components\TextInput::make('whatsapp')
                                    ->label('WhatsApp Numarası')
                                    ->tel()
                                    ->helperText('Format: 905551234567'),
                            ]),

                        // Footer Metinleri
                        Forms\Components\Tabs\Tab::make('Footer')
                            ->schema([
                                Forms\Components\Textarea::make('footer_about')
                                    ->label('Hakkımızda Metni')
                                    ->default('Güvenlik ve teknoloji altyapılarınız için profesyonel çözümler.')
                                    ->rows(2)
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('footer_newsletter_title')
                                    ->label('Bülten Başlığı')
                                    ->default('Bültenimize Abone Olun'),

                                Forms\Components\TextInput::make('footer_newsletter_desc')
                                    ->label('Bülten Açıklaması')
                                    ->default('E-posta ile güncellemelerden haberdar olun'),

                                Forms\Components\TextInput::make('copyright')
                                    ->label('Copyright Metni')
                                    ->default('© [YEAR] SOHO Güvenlik Sistemleri. Tüm hakları saklıdır.')
                                    ->helperText('[YEAR] otomatik yıl olarak değişir')
                                    ->columnSpanFull(),
                            ]),

                        // Butonlar & Formlar
                        Forms\Components\Tabs\Tab::make('Butonlar & Formlar')
                            ->schema([
                                Forms\Components\Section::make('Buton Metinleri')
                                    ->schema([
                                        Forms\Components\TextInput::make('btn_explore')
                                            ->label('Keşfet Butonu')
                                            ->default('Keşfetmeye Başla'),

                                        Forms\Components\TextInput::make('btn_submit')
                                            ->label('Gönder Butonu')
                                            ->default('Gönder'),

                                        Forms\Components\TextInput::make('btn_subscribe')
                                            ->label('Abone Ol Butonu')
                                            ->default('Abone Ol'),

                                        Forms\Components\TextInput::make('btn_contact')
                                            ->label('İletişim Butonu')
                                            ->default('İletişime Geç'),

                                        Forms\Components\TextInput::make('btn_quote')
                                            ->label('Teklif Al Butonu')
                                            ->default('Teklif Al'),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Form Placeholder\'ları')
                                    ->schema([
                                        Forms\Components\TextInput::make('placeholder_name')
                                            ->label('İsim Alanı')
                                            ->default('Adınız Soyadınız'),

                                        Forms\Components\TextInput::make('placeholder_email')
                                            ->label('E-posta Alanı')
                                            ->default('E-posta Adresiniz'),

                                        Forms\Components\TextInput::make('placeholder_phone')
                                            ->label('Telefon Alanı')
                                            ->default('Telefon Numaranız'),

                                        Forms\Components\TextInput::make('placeholder_subject')
                                            ->label('Konu Alanı')
                                            ->default('Konu'),

                                        Forms\Components\TextInput::make('placeholder_message')
                                            ->label('Mesaj Alanı')
                                            ->default('Mesajınız'),
                                    ])
                                    ->columns(2),
                            ]),

                        // SEO
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                Forms\Components\Textarea::make('meta_description')
                                    ->label('Meta Description')
                                    ->default('İzmir\'de güvenlik sistemleri, kamera sistemleri ve alarm sistemleri konusunda uzman ekibimizle hizmetinizdeyiz.')
                                    ->rows(2)
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('meta_keywords')
                                    ->label('Meta Keywords')
                                    ->default('güvenlik kamera, alarm sistemi, izmir güvenlik, kamera sistemi')
                                    ->rows(2)
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('google_analytics')
                                    ->label('Google Analytics ID')
                                    ->placeholder('G-XXXXXXXXXX'),

                                Forms\Components\TextInput::make('google_tagmanager')
                                    ->label('Google Tag Manager ID')
                                    ->placeholder('GTM-XXXXXXX'),
                            ]),

                        // Sayfa Başlıkları
                        Forms\Components\Tabs\Tab::make('Sayfa Başlıkları')
                            ->schema([
                                Forms\Components\TextInput::make('page_home')
                                    ->label('Ana Sayfa')
                                    ->default('Ana Sayfa'),

                                Forms\Components\TextInput::make('page_about')
                                    ->label('Hakkımızda Sayfası')
                                    ->default('Hakkımızda'),

                                Forms\Components\TextInput::make('page_contact')
                                    ->label('İletişim Sayfası')
                                    ->default('İletişim'),

                                Forms\Components\TextInput::make('page_references')
                                    ->label('Referanslar Sayfası')
                                    ->default('Referanslarımız'),

                                Forms\Components\TextInput::make('page_services')
                                    ->label('Hizmetler Sayfası')
                                    ->default('Hizmetlerimiz'),
                            ])
                            ->columns(2),

                        // Mesajlar
                        Forms\Components\Tabs\Tab::make('Mesajlar')
                            ->schema([
                                Forms\Components\TextInput::make('msg_no_services')
                                    ->label('Hizmet Yok Mesajı')
                                    ->default('Henüz hizmet eklenmemiş.'),

                                Forms\Components\TextInput::make('msg_no_clients')
                                    ->label('Müşteri Yok Mesajı')
                                    ->default('Henüz referans eklenmemiş.'),

                                Forms\Components\TextInput::make('msg_no_testimonials')
                                    ->label('Yorum Yok Mesajı')
                                    ->default('Henüz yorum eklenmemiş.'),

                                Forms\Components\TextInput::make('msg_loading')
                                    ->label('Yükleniyor Mesajı')
                                    ->default('Yükleniyor...'),

                                Forms\Components\TextInput::make('msg_error')
                                    ->label('Hata Mesajı')
                                    ->default('Bir hata oluştu. Lütfen tekrar deneyin.'),

                                Forms\Components\TextInput::make('msg_success')
                                    ->label('Başarılı Mesajı')
                                    ->default('İşleminiz başarıyla tamamlandı!'),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Anahtar')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Değer')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Güncellenme')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSettings::route('/'),
        ];
    }
}
