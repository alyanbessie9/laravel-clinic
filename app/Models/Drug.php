<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Drug extends Model
{
    protected $fillable = [
        'drug_name',
        'drug_type',
        'description',
        'composition',
        'packaging',
        'dosage',
        'contraindications',
        'side_effects',
        'price',
        'currency',
        'expiration_date',
    ];
    // Function to fetch data from API
    public static function fetchFromApi()
    {
        self::checkApiReachability();
        $response = Http::get('http://localhost:8080/drugs');
        return $response->json();
    }

    // Function to send data to API
    public static function sendToApi($data)
    {
        self::checkApiReachability();
        $response = Http::post('http://localhost:8080/drugs', $data);
        return $response->json();
    }

    // Function to update data via API
    public static function updateToApi($id, $data)
    {
        self::checkApiReachability();
        $response = Http::put("http://localhost:8080/drugs/{$id}", $data);
        return $response->json();
    }

    // Function to delete data via API
    public static function deleteFromApi($id)
    {
        self::checkApiReachability();
        $response = Http::delete("http://localhost:8080/drugs/{$id}");
        return $response->json();
    }

    // Function to check if API is reachable
    protected static function checkApiReachability()
    {
        try {
            $response = Http::get('http://localhost:8080/ping'); // Assuming the API has a /ping endpoint
            if (!$response->successful()) {
                throw new \Exception('API is not reachable.');
            }
        } catch (\Exception $e) {
            throw new \Exception('API is not reachable.');
        }
    }
}
