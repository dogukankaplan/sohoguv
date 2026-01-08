<?php

namespace App\Filament\Resources\ContactSubmissionResource\Pages;

use App\Filament\Resources\ContactSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactSubmission extends ViewRecord
{
    protected static string $resource = ContactSubmissionResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        if ($this->record->status === 'new') {
            $this->record->update(['status' => 'read']);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
