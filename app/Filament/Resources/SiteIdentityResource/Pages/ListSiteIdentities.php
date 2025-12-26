<?php

namespace App\Filament\Resources\SiteIdentityResource\Pages;

use App\Filament\Resources\SiteIdentityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\SiteIdentity;

class ListSiteIdentities extends ListRecords
{
    protected static string $resource = SiteIdentityResource::class;

    protected function getHeaderActions(): array
    {
        // Only allow creating if no record exists
        return [
            Actions\CreateAction::make()
                ->visible(fn() => SiteIdentity::count() === 0),
        ];
    }
}
