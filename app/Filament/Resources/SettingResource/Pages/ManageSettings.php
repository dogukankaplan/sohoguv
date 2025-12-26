<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Notifications\Notification;

class ManageSettings extends Page
{
    protected static string $resource = SettingResource::class;
    protected static string $view = 'filament.resources.setting-resource.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        // Load all settings into form data
        $settings = Setting::pluck('value', 'key')->toArray();

        // Decode JSON values for FileUpload fields
        foreach ($settings as $key => $value) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $settings[$key] = $decoded;
            }
        }

        $this->form->fill($settings);
    }

    public function form(Form $form): Form
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
                                    ->default('SOHO Güvenlik Sistemleri'),

                                Forms\Components\TextInput::make('site_tagline')
                                    ->label('Site Sloganı')
                                    ->default('Güvenliği Sanata Dönüştürüyoruz'),

                                Forms\Components\FileUpload::make('logo')
                                    ->label('Site Logosu')
                                    ->image()
                                    ->directory('settings'),

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

                                Forms\Components\TextInput::make('email')
                                    ->label('E-posta')
                                    ->email()
                                    ->default('info@sohoguvenlik.com'),

                                Forms\Components\Textarea::make('address')
                                    ->label('Adres')
                                    ->default('İstanbul, Türkiye')
                                    ->rows(2)
                                    ->columnSpanFull(),
                            ]),

                        // Sosyal Medya
                        Forms\Components\Tabs\Tab::make('Sosyal Medya')
                            ->schema([
                                Forms\Components\TextInput::make('facebook')
                                    ->label('Facebook')
                                    ->url(),

                                Forms\Components\TextInput::make('instagram')
                                    ->label('Instagram')
                                    ->url(),

                                Forms\Components\TextInput::make('linkedin')
                                    ->label('LinkedIn')
                                    ->url(),

                                Forms\Components\TextInput::make('twitter')
                                    ->label('Twitter/X')
                                    ->url(),
                            ]),

                        // Footer
                        Forms\Components\Tabs\Tab::make('Footer')
                            ->schema([
                                Forms\Components\Textarea::make('footer_about')
                                    ->label('Hakkımızda Metni')
                                    ->default('Güvenlik ve teknoloji altyapılarınız için profesyonel çözümler.')
                                    ->rows(2)
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('copyright')
                                    ->label('Copyright Metni')
                                    ->default('© [YEAR] SOHO Güvenlik Sistemleri. Tüm hakları saklıdır.')
                                    ->helperText('[YEAR] otomatik yıl olarak değişir')
                                    ->columnSpanFull(),
                            ]),

                        // Butonlar
                        Forms\Components\Tabs\Tab::make('Butonlar')
                            ->schema([
                                Forms\Components\TextInput::make('btn_explore')
                                    ->label('Keşfet Butonu')
                                    ->default('Keşfetmeye Başla'),

                                Forms\Components\TextInput::make('btn_contact')
                                    ->label('İletişim Butonu')
                                    ->default('İletişime Geç'),

                                Forms\Components\TextInput::make('btn_quote')
                                    ->label('Teklif Al Butonu')
                                    ->default('Teklif Al'),

                                Forms\Components\TextInput::make('btn_submit')
                                    ->label('Gönder Butonu')
                                    ->default('Gönder'),
                            ])
                            ->columns(2),

                        // Sayfa Başlıkları
                        Forms\Components\Tabs\Tab::make('Sayfa Başlıkları')
                            ->schema([
                                Forms\Components\TextInput::make('page_home')
                                    ->label('Ana Sayfa')
                                    ->default('Ana Sayfa'),

                                Forms\Components\TextInput::make('page_about')
                                    ->label('Hakkımızda')
                                    ->default('Hakkımızda'),

                                Forms\Components\TextInput::make('page_contact')
                                    ->label('İletişim')
                                    ->default('İletişim'),

                                Forms\Components\TextInput::make('page_services')
                                    ->label('Hizmetler')
                                    ->default('Hizmetlerimiz'),

                                Forms\Components\TextInput::make('page_references')
                                    ->label('Referanslar')
                                    ->default('Referanslarımız'),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('save')
                ->label('Kaydet')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            // Skip null or empty values
            if ($value === null || $value === '') {
                continue;
            }

            // Convert arrays (from FileUpload) to JSON
            if (is_array($value)) {
                $value = json_encode($value);
            }

            // Ensure value is a string
            $value = (string) $value;

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Notification::make()
            ->title('Ayarlar başarıyla kaydedildi')
            ->success()
            ->send();
    }
}
