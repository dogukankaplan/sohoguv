<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRecords;
use Filament\Notifications\Notification;

class ManageSettings extends ManageRecords
{
    protected static string $resource = SettingResource::class;

    public function form(Form $form): Form
    {
        // Get all settings as key-value pairs
        $settings = Setting::pluck('value', 'key')->toArray();

        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([
                        // Site Bilgileri
                        Forms\Components\Tabs\Tab::make('Site Bilgileri')
                            ->schema([
                                Forms\Components\TextInput::make('site_name')
                                    ->label('Site Adı')
                                    ->default($settings['site_name'] ?? 'SOHO Güvenlik Sistemleri')
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('site_tagline')
                                    ->label('Site Sloganı')
                                    ->default($settings['site_tagline'] ?? 'Güvenliği Sanata Dönüştürüyoruz')
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('logo')
                                    ->label('Site Logosu')
                                    ->image()
                                    ->directory('settings')
                                    ->default($settings['logo'] ?? null),

                                Forms\Components\FileUpload::make('favicon')
                                    ->label('Favicon')
                                    ->image()
                                    ->directory('settings')
                                    ->default($settings['favicon'] ?? null),
                            ]),

                        // İletişim
                        Forms\Components\Tabs\Tab::make('İletişim')
                            ->schema([
                                Forms\Components\TextInput::make('phone')
                                    ->label('Telefon')
                                    ->tel()
                                    ->default($settings['phone'] ?? '+90 (555) 123 45 67'),

                                Forms\Components\TextInput::make('email')
                                    ->label('E-posta')
                                    ->email()
                                    ->default($settings['email'] ?? 'info@sohoguvenlik.com'),

                                Forms\Components\Textarea::make('address')
                                    ->label('Adres')
                                    ->default($settings['address'] ?? 'İstanbul, Türkiye')
                                    ->rows(2)
                                    ->columnSpanFull(),
                            ]),

                        // Sosyal Medya
                        Forms\Components\Tabs\Tab::make('Sosyal Medya')
                            ->schema([
                                Forms\Components\TextInput::make('facebook')
                                    ->label('Facebook')
                                    ->url()
                                    ->default($settings['facebook'] ?? null),

                                Forms\Components\TextInput::make('instagram')
                                    ->label('Instagram')
                                    ->url()
                                    ->default($settings['instagram'] ?? null),

                                Forms\Components\TextInput::make('linkedin')
                                    ->label('LinkedIn')
                                    ->url()
                                    ->default($settings['linkedin'] ?? null),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('save')
                ->label('Kaydet')
                ->action('save')
                ->color('primary'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Notification::make()
            ->title('Ayarlar kaydedildi')
            ->success()
            ->send();
    }
}
