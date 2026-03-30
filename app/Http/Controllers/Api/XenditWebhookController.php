<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class XenditWebhookController extends Controller
{
    /**
     * Handle Xendit payment notification webhook.
     */
    public function handle(Request $request)
    {
        $payload = $request->all();
        $token = $request->header('x-callback-token') ?? $request->header('X-Callback-Token');

        // Debug logging for troubleshooting
        Log::info('Xendit Webhook Headers: ' . json_encode($request->headers->all()));
        
        // Security check for Xendit callback token
        if ($token !== config('services.xendit.webhook_token')) {
            Log::warning('Unauthorized Xendit Webhook attempt. Received token: ' . ($token ?? 'NULL') . ' vs registered token: ' . (config('services.xendit.webhook_token') ?? 'NOT_SET'));
            return response()->json(['message' => 'Unauthorized Signature'], 401);
        }

        $invoiceStatus = $payload['status'] ?? null;
        $externalId = $payload['external_id'] ?? null;

        if ($invoiceStatus === 'PAID') {
            $transaction = Transaction::where('invoice_number', $externalId)->first();

            if ($transaction && $transaction->status !== 'paid') {
                $transaction->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                    'payment_method' => $payload['payment_channel'] ?? 'Xendit',
                    'meta' => json_encode($payload)
                ]);

                Log::info("Transaction {$transaction->invoice_number} successfully secured via Xendit.");
            }
        }

        return response()->json(['success' => true]);
    }
}
