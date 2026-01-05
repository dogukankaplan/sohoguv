<?php

namespace App\Filament\Resources\SolutionPartnerResource\Pages;

use App\Filament\Resources\SolutionPartnerResource;
use Filament\Resources\Pages\ListRecords;

class ListSolutionPartners extends ListRecords
{
    protected static string $resource = SolutionPartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
