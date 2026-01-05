<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

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
        // Handle logo upload from Livewire temporary storage
        if (isset($data['logo'])) {
            $logo = $data['logo'];

            // If it's a TemporaryUploadedFile, move it to permanent storage
            if ($logo instanceof TemporaryUploadedFile) {
                $filename = $logo->store('clients', 'public');
                $data['logo'] = $filename;
            }
            // If it's already a string (existing file), keep it
            elseif (is_string($logo)) {
                $data['logo'] = $logo;
            }
        }

        return $data;
    }
}
