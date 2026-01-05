<?php

namespace App\Filament\Resources\SolutionPartnerResource\Pages;

use App\Filament\Resources\SolutionPartnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSolutionPartner extends EditRecord
{
    protected static string $resource = SolutionPartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
