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
        // Check if there's an uploaded file in the request
        if (request()->hasFile('logo')) {
            $file = request()->file('logo');
            $filename = $file->store('clients', 'public');
            $data['logo'] = $filename;
        }

        $record->update($data);

        return $record;
    }
}
