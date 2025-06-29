<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // Don't forget to import Log

class MpesaPaymentController extends Controller
{
    public function showForm()
    {
        return view('mpesa.form');
    }

    public function pay(Request $request)
    {
        // STEP 1: Get the Bearer token
        $authUrl = 'https://api.sandbox.vm.co.mz:18352/ipg/v1x/token/';
        $apiKey = env('MPESA_API_KEY'); // <<< MOVE TO .ENV !!!
        $publicKey = env('MPESA_PUBLIC_KEY'); // <<< MOVE TO .ENV !!!

        Log::info('Mpesa Auth Request', ['url' => $authUrl, 'apiKey' => $apiKey, 'publicKey' => $publicKey]);

        $authResponse = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Origin' => '*',
            'apiKey' => $apiKey,
            'publicKey' => $publicKey,
            'User-Agent' => 'Mpesa-Laravel-Client/1.0', // Add this line
        ])->post($authUrl);

        Log::info('Mpesa Auth Response', [
            'status' => $authResponse->status(),
            'body' => $authResponse->body(),
            'json' => $authResponse->json(),
            'ok' => $authResponse->ok(),
        ]);


        if (!$authResponse->ok()) {
            Log::error('Mpesa Auth Failed: HTTP Status not OK', [
                'status' => $authResponse->status(),
                'body' => $authResponse->body(),
            ]);
            return view('mpesa.result', [
                'status' => $authResponse->status(),
                'body' => $authResponse->body(),
                'json' => null,
            ]);
        }

        $token = $authResponse->json()['output_Token'] ?? null;

        if (!$token) {
            Log::error('Mpesa Auth Failed: Token missing', ['response' => $authResponse->json()]);
            return view('mpesa.result', [
                'status' => 401,
                'body' => 'Token missing in authentication response',
                'json' => null,
            ]);
        }

        Log::info('Mpesa Token Retrieved Successfully', ['token_length' => strlen($token)]);


        // STEP 2: Make the actual payment request
        $paymentUrl = 'https://api.sandbox.vm.co.mz:18352/ipg/v1x/c2bPayment/singleStage/';

        // Add server-side validation (CRITICAL, as discussed previously)
        $validatedData = $request->validate([
            'transaction_reference' => 'required|string|max:255',
            'customer_msisdn' => 'required|string|regex:/^2588[4-5]\d{7}$/', // Example regex for Mozambique mobile numbers
            'amount' => 'required|numeric|min:1',
            'third_party_reference' => 'required|string|max:255',
            'service_provider_code' => 'required|string|max:255',
        ]);


        $payload = [
            'input_TransactionReference' => $validatedData['transaction_reference'],
            'input_CustomerMSISDN' => $validatedData['customer_msisdn'],
            'input_Amount' => (float)$validatedData['amount'], // Ensure amount is float/decimal if API expects it
            'input_ThirdPartyReference' => $validatedData['third_party_reference'],
            'input_ServiceProviderCode' => $validatedData['service_provider_code'],
        ];

        Log::info('Mpesa Payment Request', [
            'url' => $paymentUrl,
            'payload' => $payload,
            'token_start' => substr($token, 0, 10) . '...' // Log only start of token
        ]);

        $paymentResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Origin' => '*', // Review if this needs to be your actual domain in production
        ])->asForm()->post($paymentUrl, $payload);

        Log::info('Mpesa Payment Response', [
            'status' => $paymentResponse->status(),
            'body' => $paymentResponse->body(),
            'json' => $paymentResponse->json(),
            'ok' => $paymentResponse->ok(),
        ]);

        return view('mpesa.result', [
            'status' => $paymentResponse->status(),
            'body' => $paymentResponse->body(),
            'json' => $paymentResponse->json(),
        ]);
    }
}