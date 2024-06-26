<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\DrugController;

Route::post('/order', [DrugController::class, 'order'])->name('order');
Route::get('/drug-price', [DrugController::class, 'showDrugPrice'])->name('drug.price');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/doctors', function () {
    // Ambil data dari API http://localhost:8080/doctors
    $response = Http::get('http://localhost:8080/doctors');
    
    // Dekode respons JSON menjadi array asosiatif
    $doctors = $response->json();

    // Ambil data user untuk relasi
    $usersResponse = Http::get('http://localhost:8080/users');
    $users = collect($usersResponse->json())->keyBy('id');

    // Map data untuk menyesuaikan id dokter dengan nama dari relasi user
    $doctors = collect($doctors)->map(function ($doctor) use ($users) {
        $doctor['name'] = $users[$doctor['user_id']]['name'];
        $doctor['email'] = $users[$doctor['user_id']]['email']; // Tambahkan email ke data dokter
        unset($doctor['user_id']); // Hapus user_id karena sudah tidak diperlukan lagi
        return $doctor;
    })->toArray();

    return view('doctors', compact('doctors'));
})->name('doctors'); // Beri nama rute 'doctors'

Route::get('/drugs', function () {
    // Ambil data dari API http://localhost:8080/drugs
    $response = Http::get('http://localhost:8080/drugs');
    $drugs = $response->json();

    return view('drugs', compact('drugs'));
})->name('drugs');