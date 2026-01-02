<?php

namespace App\Filament\Pages;

use App\Models\Section;
use App\Models\Setting;
use Filament\Forms\Components\Section as LayoutSection;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Actions\Action;

class ManageSolutions extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static string $view = 'filament.pages.manage-solutions';
    protected static ?string $title = 'Çözümler Sayfası Yönetimi';
    protected static ?string $navigationGroup = 'İçerik Yönetimi';
    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public function mount(): void
    {
        // Hero Section
        $hero = Section::where('type', 'solutions_hero')->first();
        $this->data['hero_title'] = $hero?->title;
        $this->data['hero_subtitle'] = $hero?->subtitle;
        $this->data['hero_content'] = $hero?->content;

        // CTA Section
        $cta = Section::where('type', 'solutions_cta')->first();
        $this->data['cta_title'] = $cta?->title;
        $this->data['cta_content'] = $cta?->content;

        // Stats Settings
        $this->data['stat_1_val'] = Setting::where('key', 'solutions_stat_1_value')->value('value');
        $this->data['stat_1_lbl'] = Setting::where('key', 'solutions_stat_1_label')->value('value');
        $this->data['stat_2_val'] = Setting::where('key', 'solutions_stat_2_value')->value('value');
        $this->data['stat_2_lbl'] = Setting::where('key', 'solutions_stat_2_label')->value('value');
        $this->data['stat_3_val'] = Setting::where('key', 'solutions_stat_3_value')->value('value');
        $this->data['stat_3_lbl'] = Setting::where('key', 'solutions_stat_3_label')->value('value');

        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Hero (Üst) Alanı')
                            ->schema([
                                TextInput::make('hero_subtitle')
                                    ->label('Üst Başlık (Küçük)')
                                    ->placeholder('Örn: Kurumsal'),
                                TextInput::make('hero_title')
                                    ->label('Ana Başlık (Büyük)')
                                    ->placeholder('Örn: Çözümlerimiz')
                                    ->required(),
                                Textarea::make('hero_content')
                                    ->label('Açıklama Metni')
                                    ->rows(3),
                            ]),
                        Tabs\Tab::make('İstatistikler')
                            ->schema([
                                LayoutSection::make('İstatistik 1')
                                    ->schema([
                                        TextInput::make('stat_1_val')->label('Değer (Örn: 500+)'),
                                        TextInput::make('stat_1_lbl')->label('Etiket (Örn: Tamamlanan Proje)'),
                                    ])->columns(2),
                                LayoutSection::make('İstatistik 2')
                                    ->schema([
                                        TextInput::make('stat_2_val')->label('Değer (Örn: %98)'),
                                        TextInput::make('stat_2_lbl')->label('Etiket (Örn: Müşteri Memnuniyeti)'),
                                    ])->columns(2),
                                LayoutSection::make('İstatistik 3')
                                    ->schema([
                                        TextInput::make('stat_3_val')->label('Değer (Örn: 24/7)'),
                                        TextInput::make('stat_3_lbl')->label('Etiket (Örn: Kesintisiz Destek)'),
                                    ])->columns(2),
                            ]),
                        Tabs\Tab::make('CTA (Alt) Alanı')
                            ->schema([
                                TextInput::make('cta_title')
                                    ->label('Başlık')
                                    ->placeholder('Örn: Projeniz İçin Hazırız'),
                                Textarea::make('cta_content')
                                    ->label('Açıklama')
                                    ->rows(3),
                            ]),
                    ])->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Save Hero
        Section::updateOrCreate(
            ['type' => 'solutions_hero'],
            [
                'title' => $data['hero_title'],
                'subtitle' => $data['hero_subtitle'],
                'content' => $data['hero_content'],
                'is_active' => true,
            ]
        );

        // Save CTA
        Section::updateOrCreate(
            ['type' => 'solutions_cta'],
            [
                'title' => $data['cta_title'],
                'content' => $data['cta_content'],
                'is_active' => true,
            ]
        );

        // Save Stats
        $stats = [
            'solutions_stat_1_value' => $data['stat_1_val'],
            'solutions_stat_1_label' => $data['stat_1_lbl'],
            'solutions_stat_2_value' => $data['stat_2_val'],
            'solutions_stat_2_label' => $data['stat_2_lbl'],
            'solutions_stat_3_value' => $data['stat_3_val'],
            'solutions_stat_3_label' => $data['stat_3_lbl'],
        ];

        foreach ($stats as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Notification::make()
            ->title('Ayarlar başarıyla kaydedildi.')
            ->success()
            ->send();
    }

    public function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Değişiklikleri Kaydet')
                ->submit('save'),
        ];
    }
}
