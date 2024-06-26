<?php

namespace App\Filament\Resources\PatientAppointmentResource\Pages;

use App\Filament\Resources\PatientAppointmentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Http;

class EditPatientAppointment extends EditRecord
{
    protected static string $resource = PatientAppointmentResource::class;

    protected function beforeSave(): void
    {
        if (!self::isApiReachable()) {
            throw new \Exception('API is not reachable.');
        }
    }

    protected static function isApiReachable(): bool
    {
        try {
            $response = Http::get('http://localhost:8080/appointments'); // Assuming the API has a /ping endpoint
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}
