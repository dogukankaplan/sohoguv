<?php

namespace App\Filament\Resources\HeroSectionResource\Pages;

use App\Filament\Resources\HeroSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditHeroSection extends EditRecord
{
    protected static string $resource = HeroSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['background_image']) && $data['background_image'] instanceof TemporaryUploadedFile) {
            $data['background_image'] = $data['background_image']->store('hero-backgrounds', 'public');
        }
        return $data;
    }
}
