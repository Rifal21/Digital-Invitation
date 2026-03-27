<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DokuService
{
    protected $clientId;
    protected $secretKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->clientId = trim(config('services.doku.client_id', ''));
        $this->secretKey = trim(config('services.doku.secret_key', ''));
        $this->baseUrl = config('services.doku.is_production') 
            ? 'https://api.doku.com' 
            : 'https://api-sandbox.doku.com';
    }

    /**
     * Create a Checkout Payment Request (Jokul Checkout)
     */
    public function createCheckout($transaction)
    {
        if (empty($this->clientId) || empty($this->secretKey)) {
            throw new \Exception('DOKU_CLIENT_ID atau DOKU_SHARED_KEY belum diisi di .env');
        }

        $requestId = $transaction->invoice_number;
        $timestamp = Carbon::now()->format('Y-m-d\TH:i:s\Z');
        $targetPath = '/checkout/v1/payment';

        $lineItems = [
            [
                'id' => (string)$transaction->package->id,
                'name' => (string)$transaction->package->name,
                'price' => (int)$transaction->subtotal,
                'quantity' => 1,
            ]
        ];

        if ($transaction->admin_fee > 0) {
            $lineItems[] = [
                'id' => 'FEE-ADM',
                'name' => 'Admin Fee',
                'price' => (int)$transaction->admin_fee,
                'quantity' => 1,
            ];
        }

        $body = [
            'order' => [
                'amount' => (int)$transaction->total_amount,
                'invoice_number' => (string)$transaction->invoice_number,
                'currency' => 'IDR',
                'callback_url' => route('transactions.history'),
                'line_items' => $lineItems,
                'auto_redirect' => true,
            ],
            'customer' => [
                'id' => (string)$transaction->user->id,
                'name' => (string)$transaction->user->name,
                'email' => (string)$transaction->user->email,
            ],
            'payment' => [
                "payment_due_date" => 60,
            ]
        ];

        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES); // Standard encode (escapes slashes)
        $digest = base64_encode(hash('sha256', $jsonBody, true));
        
        $signaturePayload = "Client-Id:{$this->clientId}\n" .
                           "Request-Id:{$requestId}\n" .
                           "Request-Timestamp:{$timestamp}\n" .
                           "Request-Target:{$targetPath}\n" .
                           "Digest:{$digest}";

        // Debug Log
        \Illuminate\Support\Facades\Log::info('DOKU_OUTGOING_DEBUG', [
            'url' => $this->baseUrl . $targetPath,
            'payload' => $signaturePayload,
            'body' => $jsonBody
        ]);

        $signature = base64_encode(hash_hmac('sha256', $signaturePayload, $this->secretKey, true));

        $response = Http::withHeaders([
            'Client-Id' => $this->clientId,
            'Request-Id' => $requestId,
            'Request-Timestamp' => $timestamp,
            "Signature"    => "HMACSHA256=$signature",
            'Content-Type' => 'application/json',
        ])->withBody($jsonBody, 'application/json')->post($this->baseUrl . $targetPath);

        if ($response->successful()) {
            return $response->json();
        }

        \Illuminate\Support\Facades\Log::error('Doku API Error Detail:', [
            'status' => $response->status(),
            'body' => $response->body()
        ]);

        throw new \Exception('Doku API Error: ' . $response->body());
    }

    /**
     * Validate Notification Signature
     */
    public function validateNotification($headers, $body, $path)
    {
        $signatureHeader = $headers['signature'][0] ?? '';
        
        $receivedSignature = '';
        if (preg_match('/HMACSHA256=([^,]+)/', $signatureHeader, $matches)) {
            $receivedSignature = trim($matches[1]);
        }

        $requestId = $headers['request-id'][0] ?? '';
        $timestamp = $headers['request-timestamp'][0] ?? '';
        $targetPath = $path; // Gunakan path dinamis

        $digest = base64_encode(hash('sha256', $body, true));
        $signaturePayload = "Client-Id:{$this->clientId}\n" .
                           "Request-Id:{$requestId}\n" .
                           "Request-Timestamp:{$timestamp}\n" .
                           "Request-Target:{$targetPath}\n" .
                           "Digest:{$digest}";

        // TAMPILKAN PAYLOAD DI LOG UNTUK DIBANDINGKAN DENGAN BRUNO/POSTMAN
        \Illuminate\Support\Facades\Log::info('DOKU_VALIDATION_PAYLOAD', [
            'payload' => $signaturePayload,
            'digest_calculated' => $digest
        ]);

        $expectedSignature = base64_encode(hash_hmac('sha256', $signaturePayload, $this->secretKey, true));

        return hash_equals($expectedSignature, $receivedSignature);
    }
}
