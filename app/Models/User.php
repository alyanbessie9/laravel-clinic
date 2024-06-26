<?php

namespace App\Models;
use Illuminate\Support\Facades\Http;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    // Function to fetch data from API
    public static function fetchFromApi()
    {
        self::checkApiReachability();
        $response = Http::get('http://localhost:8080/users');
        return $response->json();
    }

    // Function to send data to API
    public static function sendToApi($data)
    {
        self::checkApiReachability();
        $response = Http::post('http://localhost:8080/users', $data);
        return $response->json();
    }

    // Function to update data via API
    public static function updateToApi($id, $data)
    {
        self::checkApiReachability();
        $response = Http::put("http://localhost:8080/users/{$id}", $data);
        return $response->json();
    }

    // Function to delete data via API
    public static function deleteFromApi($id)
    {
        self::checkApiReachability();
        $response = Http::delete("http://localhost:8080/users/{$id}");
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
