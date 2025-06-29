<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

        // IMPORTANT: Move these to your .env file and access via config()
        // Ensure you use your ACTUAL API KEY and the 4096-bit PUBLIC KEY
        // from your M-Pesa developer portal account profile.
        $apiKey = config('services.mpesa.api_key');
        $publicKey = config('services.mpesa.public_key');

        if (empty($apiKey) || empty($publicKey)) {
            Log::error('Mpesa credentials not configured in .env or config/services.php');
            return view('mpesa.result', [
                'status' => 500,
                'body' => 'M-Pesa API credentials are not configured. Please check your .env and config/services.php.',
                'json' => null,
            ]);
        }

        // Generate the Encoded API Key for the Authorization header
        $encodedApiKey = $this->generateEncodedApiKey($apiKey, $publicKey);

        if (!$encodedApiKey) {
            Log::error('Failed to generate encoded API key.');
            return view('mpesa.result', [
                'status' => 500,
                'body' => 'Internal Server Error: Could not encode API key. Check logs for details.',
                'json' => null,
            ]);
        }

        Log::info('Mpesa Auth Request', ['url' => $authUrl, 'encodedApiKey_length' => strlen($encodedApiKey)]);

        //ORIGIN VALUE to confirm if it's right
        $origin = 'developer.mpesa.vm.co.mz';  //<-------- CHECK THIS VALUE CAREFULLY!

        $authResponse = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Origin' => $origin, // ENSURE THIS IS EXACTLY WHAT MPESA EXPECTS
            'Authorization' => 'Bearer ' . $encodedApiKey,
            'User-Agent' => 'Mpesa-Laravel-Client/1.0', // Good practice to add
        ])->timeout(30)->post($authUrl); // Added timeout


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
                'headers' => $authResponse->headers(), // Log headers for more clues
            ]);
            return view('mpesa.result', [
                'status' => $authResponse->status(),
                'body' => 'M-Pesa Authentication Failed: ' . $authResponse->body(),
                'json' => $authResponse->json(), // Include JSON if available for more details
                'headers' => $authResponse->headers(), // pass headers to view
            ]);
        }

        $token = $authResponse->json()['output_Token'] ?? null;

        if (!$token) {
            Log::error('Mpesa Auth Failed: Token missing', ['response' => $authResponse->json()]);
            return view('mpesa.result', [
                'status' => 401,
                'body' => 'Token missing in authentication response',
                'json' => $authResponse->json(),
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
            'input_Amount' => (float)$validatedData['amount'],
            'input_ThirdPartyReference' => $validatedData['third_party_reference'],
            'input_ServiceProviderCode' => $validatedData['service_provider_code'],
        ];

        Log::info('Mpesa Payment Request', [
            'url' => $paymentUrl,
            'payload' => $payload,
            'token_start' => substr($token, 0, 10) . '...'
        ]);

        $paymentResponse = Http::withHeaders([
            'Content-Type' => 'application/json', // <--- ADDED BASED ON DOCS
            'Authorization' => 'Bearer ' . $token,
            'Origin' => $origin, // ENSURE THIS IS EXACTLY WHAT MPESA EXPECTS
            'User-Agent' => 'Mpesa-Laravel-Client/1.0',
        ])->timeout(30)->post($paymentUrl, $payload);

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

    /**
     * Encrypts the API Key using the Public Key and Base64 encodes the result.
     * Matches the Java example provided.
     *
     * @param string $apiKey Your M-Pesa API Key
     * @param string $publicKey Your M-Pesa Public Key (Base64 encoded X.509 format)
     * @return string|null The Base64 encoded encrypted API Key, or null on error.
     */
    private function generateEncodedApiKey(string $apiKey, string $publicKey): ?string
    {
        try {
            // **CRITICAL CLEANING:** Aggressively remove any character that is NOT a valid Base64 character.
            // This is crucial for handling potential copy-paste errors and hidden characters.
            // Base64 alphabet: A-Z, a-z, 0-9, +, /, and = (for padding).
            $cleanedPublicKey = preg_replace('/[^a-zA-Z0-9\+\/=]/', '', $publicKey);

            // Optional: Verify the cleaned key is indeed valid Base64 BEFORE PEM wrapping
            // (Use strict mode: true for base64_decode)
            if (base64_decode($cleanedPublicKey, true) === false) {
                Log::error('The provided public key, even after aggressive cleaning, is not a valid Base64 string. Please verify the key content from your M-Pesa account profile.', [
                    'cleaned_key_start' => substr($cleanedPublicKey, 0, 100) . (strlen($cleanedPublicKey) > 100 ? '...' : ''),
                    'cleaned_key_length' => strlen($cleanedPublicKey)
                ]);
                return null;
            }

            // Construct the PEM format. The key itself is already Base64 encoded.
            $pemPublicKey = '-----BEGIN PUBLIC KEY-----' . "\n"
                            . chunk_split($cleanedPublicKey, 64, "\n")
                            . '-----END PUBLIC KEY-----' . "\n";

            Log::debug('Generated PEM Public Key:', ['pem' => $pemPublicKey]);

            // 2. Get the public key resource
            $publicKeyResource = openssl_get_publickey($pemPublicKey);
            if ($publicKeyResource === false) {
                // This indicates an issue with the PEM format or the Base64 data within it.
                Log::error('Failed to get public key resource from PEM format. This usually means the PEM string is malformed or the Base64 data within it is invalid. Verify your M-Pesa Public Key.', [
                    'openssl_error' => openssl_error_string(),
                    'pem_attempted_start' => substr($pemPublicKey, 0, 200) . (strlen($pemPublicKey) > 200 ? '...' : '') // Log a portion of the PEM string that failed
                ]);
                return null;
            }

            $encryptedApiKey = '';
            // 3. Encrypt the API Key using RSA public encryption with PKCS1 padding
            // OPENSSL_PKCS1_PADDING is the equivalent to Java's default "RSA" padding.
            $encryptionSuccess = openssl_public_encrypt(
                $apiKey,
                $encryptedApiKey,
                $publicKeyResource,
                OPENSSL_PKCS1_PADDING
            );

            // Free the key resource
            openssl_free_key($publicKeyResource);

            if (!$encryptionSuccess) {
                Log::error('RSA encryption of API key failed.', ['openssl_error' => openssl_error_string()]);
                return null;
            }

            // 4. Base64 encode the encrypted (binary) API Key
            return base64_encode($encryptedApiKey);

        } catch (\Exception $e) {
            Log::error('Exception during API Key encoding: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return null;
        }
    }
}