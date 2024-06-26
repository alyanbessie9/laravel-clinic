<?php

namespace App\Filament\Resources\DoctorResource\Pages;

use App\Filament\Resources\DoctorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Http;

class CreateDoctor extends CreateRecord
{
    protected static string $resource = DoctorResource::class;

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
            $response = Http::get('http://localhost:8080/doctors'); // Assuming the API has a /ping endpoint
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}
