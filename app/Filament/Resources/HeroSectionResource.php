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

                Forms\Components\TextInput::make('badge_text')
                    ->label('Rozet Yazısı')
                    ->placeholder('Yeni Nesil Güvenlik Sistemleri')
                    ->maxLength(255),

                Forms\Components\TextInput::make('title')
                    ->label('Ana Başlık')
                    ->required()
                    ->placeholder('Güvenliği Sanata Dönüştürdük')
                    ->maxLength(255),

                Forms\Components\Textarea::make('subtitle')
                    ->label('Alt Başlık')
                    ->rows(2)
                    ->placeholder('SOHO, kurumsal altyapınızı...'),

                Forms\Components\TextInput::make('cta_text')
                    ->label('Buton Yazısı')
                    ->placeholder('Keşfetmeye Başla')
                    ->maxLength(100),

                Forms\Components\TextInput::make('cta_url')
                    ->label('Buton URL')
                    ->placeholder('#services')
                    ->maxLength(255),

                Forms\Components\FileUpload::make('background_image')
                    ->label('Arkaplan Görseli')
                    ->image()
                    ->directory('hero-backgrounds')
                    ->disk('public')
                    ->maxSize(10240),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Sadece bir hero her sayfa için aktif olmalı'),
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
