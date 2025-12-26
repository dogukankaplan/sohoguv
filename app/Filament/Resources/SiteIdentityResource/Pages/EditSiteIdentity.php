<?php

namespace App\Filament\Resources\SiteIdentityResource\Pages;

use App\Filament\Resources\SiteIdentityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiteIdentity extends EditRecord
{
    protected static string $resource = SiteIdentityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // No delete action to prevent losing the only record easily
            // Actions\DeleteAction::make(),
        ];
    }
}
