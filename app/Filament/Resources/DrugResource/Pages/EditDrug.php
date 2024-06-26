<?php

namespace App\Filament\Resources\DrugResource\Pages;

use App\Filament\Resources\DrugResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Http;

class EditDrug extends EditRecord
{
    protected static string $resource = DrugResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function beforeSave(): void
    {
        if (!self::isApiReachable()) {
            throw new \Exception('API is not reachable.');
        }
    }

    // Function to check if API is reachable
    protected static function isApiReachable(): bool
    {
        try {
            $response = Http::get('http://localhost:8080/drugs'); // Assuming the API has a /ping endpoint
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}
