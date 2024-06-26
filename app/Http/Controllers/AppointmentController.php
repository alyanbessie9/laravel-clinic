<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AppointmentController extends Controller
{
    public function index()
    {
        try {
            $response = Http::get('http://localhost:8080/appointments'); // Ganti dengan URL API yang sesuai
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch appointments from API.'], 500);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|integer',
            'doctor_id' => 'required|integer',
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string',
            'prescription' => 'nullable|string',
            'status' => 'required|string|in:scheduled,completed',
        ]);

        try {
            $response = Http::post('http://localhost:8080/appointments', $validatedData); // Ganti dengan URL API yang sesuai
            return response()->json($response->json(), 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create appointment.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $response = Http::get("http://localhost:8080/appointments/{$id}"); // Ganti dengan URL API yang sesuai
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Appointment not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|integer',
            'doctor_id' => 'required|integer',
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string',
            'prescription' => 'nullable|string',
            'status' => 'required|string|in:scheduled,completed',
        ]);

        try {
            $response = Http::put("http://localhost:8080/appointments/{$id}", $validatedData); // Ganti dengan URL API yang sesuai
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update appointment.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete("http://localhost:8080/appointments/{$id}"); // Ganti dengan URL API yang sesuai
            return response()->json(['message' => 'Appointment deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete appointment.'], 500);
        }
    }
}
