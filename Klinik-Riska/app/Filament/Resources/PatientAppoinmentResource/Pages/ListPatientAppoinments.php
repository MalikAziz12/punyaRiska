<?php

namespace App\Filament\Resources\PatientAppoinmentResource\Pages;

use App\Filament\Resources\PatientAppoinmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatientAppoinments extends ListRecords
{
    protected static string $resource = PatientAppoinmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
