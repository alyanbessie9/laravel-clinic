<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Filament\Resources\PatientResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Http;

class CreatePatient extends CreateRecord
{
    protected static string $resource = PatientResource::class;

    protected function beforeCreate(): void
    {
        if (!self::isApiReachable()) {
            throw new \Exception('API is not reachable.');
        }
    }

    // Function to check if API is reachable
    protected static function isApiReachable(): bool
    {
        try {
            $response = Http::get('http://localhost:8080/patients'); // Assuming the API has a /ping endpoint
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}

