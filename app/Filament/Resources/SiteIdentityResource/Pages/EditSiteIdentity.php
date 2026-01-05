<?php

namespace App\Filament\Resources\SiteIdentityResource\Pages;

use App\Filament\Resources\SiteIdentityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditSiteIdentity extends EditRecord
{
    protected static string $resource = SiteIdentityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['logo']) && $data['logo'] instanceof TemporaryUploadedFile) {
            $data['logo'] = $data['logo']->store('site-identity', 'public');
        }

        if (isset($data['favicon']) && $data['favicon'] instanceof TemporaryUploadedFile) {
            $data['favicon'] = $data['favicon']->store('site-identity', 'public');
        }

        return $data;
    }
}
