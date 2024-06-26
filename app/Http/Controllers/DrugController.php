<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DrugController extends Controller
{
    public function order(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'drug_id' => 'required|integer',
            'quantity' => 'required|integer|min:1|max:10',
            'total_price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'prescription' => 'nullable|string|max:255',
        ]);

        // Assuming you have an endpoint to store orders, replace 'http://localhost:8080/transactions' with your actual endpoint
        $apiUrl = 'http://localhost:8080/transactions';

        $formData = [
            'patient_id' => auth()->user()->id, // Assuming the authenticated user is the patient making the order
            'drug_id' => $request->input('drug_id'),
            'quantity' => $request->input('quantity'),
            'total_price' => $request->input('total_price'),
            'currency' => $request->input('currency'),
            'prescription' => $request->input('prescription'),
        ];

        try {
            $response = Http::post($apiUrl, $formData);

            if (!$response->successful()) {
                throw new \Exception('Failed to place order.');
            }

            return redirect()->back()->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to place order. Please try again later.');
        }
    }

    public function showDrugPrice(Request $request)
    {
        // Assuming you have a method to retrieve drug price based on drug_id
        $drugId = $request->input('drug_id');
        $apiUrl = 'http://localhost:8080/drugs/' . $drugId;

        try {
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                $drug = $response->json();
                return view('drug_price', compact('drug'));
            } else {
                throw new \Exception('Failed to fetch drug price.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch drug price. Please try again later.');
        }
    }
}
