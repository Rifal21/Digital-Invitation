<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\DokuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DokuNotificationController extends Controller
{
    /**
     * Handle Async Doku Notifications
     */
    public function __invoke(Request $request, DokuService $dokuService)
    {
        $headers = collect($request->headers->all())->mapWithKeys(function ($item, $key) {
            return [strtolower($key) => $item];
        })->toArray();
        $body = $request->getContent();

        Log::info('DOKU_WEBHOOK_RECEIVED', [
            'headers' => $headers,
            'body' => json_decode($body, true)
        ]);

        $path = '/' . ltrim($request->getPathInfo(), '/');

        // if (!$dokuService->validateNotification($headers, $body, $path)) {
        //     Log::warning('DOKU_WEBHOOK_SIGNATURE_INVALID');
        //     return response()->json(['message' => 'Invalid Signature'], 401);
        // }

        $data = json_decode($body, true);
        $invoiceNumber = $data['order']['invoice_number'] ?? '';
        $transactionStatus = $data['transaction']['status'] ?? '';
        
        $transaction = Transaction::where('invoice_number', $invoiceNumber)->first();

        // dd($transaction);
        if (!$transaction) {
            Log::error("DOKU_WEBHOOK_TRANSACTION_NOT_FOUND: {$invoiceNumber}");
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Jika status success, ubah jadi paid
        if (strtoupper($transactionStatus) === 'SUCCESS') {
            $transaction->update(['status' => 'paid']);
            Log::info("DOKU_WEBHOOK_SUCCESS: Transaction {$transaction->invoice_number} is now PAID");
        }

        // Doku Jokul mengharapkan response 200 OK untuk menghentikan retrying
        return response('OK', 200);
    }
}
