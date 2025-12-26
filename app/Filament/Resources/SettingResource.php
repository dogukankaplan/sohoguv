<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Resources\Resource;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Site Ayarları';
    protected static ?string $modelLabel = 'Ayar';
    protected static ?string $pluralModelLabel = 'Ayarlar';
    protected static ?string $navigationGroup = 'Sistem';
    protected static ?int $navigationSort = 99;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSettings::route('/'),
        ];
    }
}
