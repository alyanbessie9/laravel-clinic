<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Http;

Route::middleware('api')->group(function () {
    Route::get('patients', [PatientController::class, 'index']);
    Route::get('patients/{id}', [PatientController::class, 'show']);
    Route::post('patients', [PatientController::class, 'store']);
    Route::put('patients/{id}', [PatientController::class, 'update']);
    Route::delete('patients/{id}', [PatientController::class, 'destroy']);

    Route::get('appointments', [AppointmentController::class, 'index']);
    Route::get('appointments/{id}', [AppointmentController::class, 'show']);
    Route::post('appointments', [AppointmentController::class, 'store']);
    Route::put('appointments/{id}', [AppointmentController::class, 'update']);
    Route::delete('appointments/{id}', [AppointmentController::class, 'destroy']);
});

Route::get('/doctors', function () {
    // Ambil data dari API http://localhost:8080/doctors
    $response = Http::get('http://localhost:8080/doctors');
    
    // Tampilkan respons API
    dd($response->json());
    // ...
});

