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

    protected function handleRecordUpdate(\Illuminate\Database\Eloquent\Model $record, array $data): \Illuminate\Database\Eloquent\Model
    {
        // Handle file upload manually
        if ($this->form->getComponent('logo')->getState()) {
            $uploadedFile = $this->form->getComponent('logo')->getState();

            if ($uploadedFile && !is_string($uploadedFile)) {
                // Store file
                $filename = $uploadedFile->store('clients', 'public');
                $data['logo'] = $filename;
            }
        }

        $record->update($data);

        return $record;
    }
}
