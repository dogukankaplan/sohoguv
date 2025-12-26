<?php

namespace App\Filament\Resources\SiteIdentityResource\Pages;

use App\Filament\Resources\SiteIdentityResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\SiteIdentity;

class CreateSiteIdentity extends CreateRecord
{
    protected static string $resource = SiteIdentityResource::class;

    protected function beforeCreate(): void
    {
        // Enforce single record check
        if (SiteIdentity::count() > 0) {
            $this->halt();
        }
    }
}
