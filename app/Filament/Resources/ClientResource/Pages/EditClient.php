<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Handle file upload
        $logo = $this->data['logo'] ?? null;

        if ($logo && is_string($logo)) {
            // Already a valid path, keep it
            $data['logo'] = $logo;
        }

        return $data;
    }
}
