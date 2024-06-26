<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::fetchFromApi(); // Mengambil data dari API
        return response()->json($patients);
    }

    public function store(Request $request)
    {
        $data = $request->only(['nik', 'name', 'gender', 'date_of_birth', 'address']);
        $patient = Patient::sendToApi($data); // Mengirim data ke API
        return response()->json($patient, 201);
    }

    public function show($id)
    {
        // Implementasikan logika untuk mengambil data pasien berdasarkan ID dari API
    }

    public function update(Request $request, $id)
    {
        // Implementasikan logika untuk mengupdate data pasien di API
    }

    public function destroy($id)
    {
        // Implementasikan logika untuk menghapus data pasien dari API
    }
}
