<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'drug_id',
        'quantity',
        'total_price',
        'currency',
        'prescription',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }

    public static function fetchFromApi()
    {
        self::checkApiReachability();
        $response = Http::get('http://localhost:8080/transactions');
        return $response->json();
    }

    public static function sendToApi($data)
    {
        self::checkApiReachability();
        $response = Http::post('http://localhost:8080/transactions', $data);
        return $response->json();
    }

    public static function updateToApi($id, $data)
    {
        self::checkApiReachability();
        $response = Http::put("http://localhost:8080/transactions/{$id}", $data);
        return $response->json();
    }

    public static function deleteFromApi($id)
    {
        self::checkApiReachability();
        $response = Http::delete("http://localhost:8080/transactions/{$id}");
        return $response->json();
    }

    protected static function checkApiReachability()
    {
        try {
            $response = Http::get('http://localhost:8080/ping'); 
            if (!$response->successful()) {
                throw new \Exception('API is not reachable.');
            }
        } catch (\Exception $e) {
            throw new \Exception('API is not reachable.');
        }
    }
}
