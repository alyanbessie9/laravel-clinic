<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Patient extends Model
{
    protected $fillable = [
        'nik',
        'name',
        'gender',
        'date_of_birth',
        'address',
    ];

    protected $hidden = [
        'password',
    ];

    // Function to fetch data from API
    public static function fetchFromApi()
    {
        self::checkApiReachability();
        $response = Http::get('http://localhost:8080/patients');
        return $response->json();
    }

    // Function to send data to API
    public static function sendToApi($data)
    {
        self::checkApiReachability();
        $response = Http::post('http://localhost:8080/patients', $data);
        return $response->json();
    }

    // Function to update data via API
    public static function updateToApi($id, $data)
    {
        self::checkApiReachability();
        $response = Http::put("http://localhost:8080/patients/{$id}", $data);
        return $response->json();
    }

    // Function to delete data via API
    public static function deleteFromApi($id)
    {
        self::checkApiReachability();
        $response = Http::delete("http://localhost:8080/patients/{$id}");
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
