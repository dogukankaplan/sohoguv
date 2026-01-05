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
        // Log what we're receiving
        \Log::info('EditClient - Before Save:', $data);

        // Ensure logo is saved
        if (isset($data['logo']) && !empty($data['logo'])) {
            \Log::info('EditClient - Logo exists in data:', ['logo' => $data['logo']]);
        } else {
            \Log::info('EditClient - Logo is missing or empty in data');
        }

        return $data;
    }

    protected function afterSave(): void
    {
        \Log::info('EditClient - After Save:', [
            'logo' => $this->record->logo,
            'all_fields' => $this->record->toArray()
        ]);
    }
}
