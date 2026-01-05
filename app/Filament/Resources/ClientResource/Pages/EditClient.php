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
        \Log::info('EditClient - Form Data Before Save:', $data);
        return $data;
    }

    protected function afterSave(): void
    {
        \Log::info('EditClient - After Save - Logo value:', ['logo' => $this->record->logo]);
        \Log::info('EditClient - Full Record:', $this->record->toArray());
    }
}
