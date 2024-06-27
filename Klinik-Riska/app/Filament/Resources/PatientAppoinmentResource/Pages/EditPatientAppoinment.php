<?php

namespace App\Filament\Resources\PatientAppoinmentResource\Pages;

use App\Filament\Resources\PatientAppoinmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPatientAppoinment extends EditRecord
{
    protected static string $resource = PatientAppoinmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
