<?php

namespace App\Services;

use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class XenditService
{
    protected $config;

    public function __construct()
    {
        $this->config = new Configuration();
        $this->config->setApiKey(config('services.xendit.api_key'));
    }

    /**
     * Create a new Xendit invoice for a transaction.
     */
    public function createInvoice($transaction)
    {
        try {
            $apiInstance = new InvoiceApi(null, $this->config);
            
            $create_invoice_request = new CreateInvoiceRequest([
                'external_id' => $transaction->invoice_number,
                'amount' => (float) $transaction->total_amount,
                'description' => 'Pembayaran Paket Memora: ' . $transaction->package->name,
                'invoice_duration' => 86400, // 24 hours
                'customer' => [
                    'given_names' => $transaction->user->name,
                    'email' => $transaction->user->email,
                ],
                'currency' => 'IDR',
                'items' => [
                    [
                        'name' => $transaction->package->name,
                        'quantity' => 1,
                        'price' => (float) $transaction->total_amount
                    ]
                ],
                'success_redirect_url' => route('transactions.history'),
                'failure_redirect_url' => route('transactions.history'),
            ]);

            $result = $apiInstance->createInvoice($create_invoice_request);

            return [
                'success' => true,
                'invoice_url' => $result['invoice_url'],
                'external_id' => $result['external_id'],
                'status' => $result['status']
            ];
        } catch (Exception $e) {
            Log::error('Xendit Invoice Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
