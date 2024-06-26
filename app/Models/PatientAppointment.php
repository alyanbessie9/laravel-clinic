<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class PatientAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'user_id',
        'appointment_date',
        'notes',
        'prescription',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function fetchFromApi()
    {
        self::checkApiReachability();
        $response = Http::get('http://localhost:8080/appointments');
        return $response->json();
    }

    public static function sendToApi($data)
    {
        self::checkApiReachability();
        $response = Http::post('http://localhost:8080/appointments', $data);
        return $response->json();
    }

    public static function updateToApi($id, $data)
    {
        self::checkApiReachability();
        $response = Http::put("http://localhost:8080/appointments/{$id}", $data);
        return $response->json();
    }

    public static function deleteFromApi($id)
    {
        self::checkApiReachability();
        $response = Http::delete("http://localhost:8080/appointments/{$id}");
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

