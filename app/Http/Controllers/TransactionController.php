<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Transaction;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of personal transactions.
     */
    public function index()
    {
        $transactions = Auth::user()->transactions()->with(['package'])->latest()->get();
        return view('transactions.history', compact('transactions'));
    }

    /**
     * Preview package before creating transaction (Cart Phase).
     */
    public function preCheckout(Package $package)
    {
        $adminFee = \App\Models\Setting::get('admin_fee', 0);
        $total = $package->price + (int)$adminFee;
        return view('transactions.checkout', compact('package', 'adminFee', 'total'));
    }

    /**
     * Confirm investment and create transaction record.
     */
    public function store(Request $request, Package $package)
    {
        $request->validate([
            'payment_type' => 'required|in:auto,manual',
            'payment_method_id' => 'required_if:payment_type,manual|exists:payment_methods,id',
        ]);

        // Cancel existing pending sessions for this package
        Auth::user()->transactions()
            ->where('package_id', $package->id)
            ->where('status', 'pending')
            ->update(['status' => 'cancelled']);

        $adminFee = \App\Models\Setting::get('admin_fee', 0);
        $total = $package->price + (int)$adminFee;
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(6));

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'invoice_number' => $invoiceNumber,
            'package_id' => $package->id,
            'subtotal' => $package->price,
            'admin_fee' => $adminFee,
            'total_amount' => $total,
            'status' => 'pending',
            'payment_method' => $request->payment_type == 'auto' ? 'Xendit' : PaymentMethod::find($request->payment_method_id)->name,
            'payment_method_id' => $request->payment_method_id,
        ]);

        // If manual, redirect to show for immediate payment details & upload
        if ($request->payment_type == 'manual') {
            return redirect()->route('transactions.show', $transaction)
                ->with('success', 'Pesanan berhasil dibuat. Silakan selesaikan pembayaran.');
        }

        // If auto, go to Xendit
        return $this->payWithXendit($transaction, new \App\Services\XenditService());
    }

    /**
     * Show the transaction details (receipt/payment status & upload portal).
     */
    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }
        
        $method = PaymentMethod::find($transaction->payment_method_id);
        
        return view('transactions.show', compact('transaction', 'method'));
    }

    /**
     * Upload payment proof (For Manual).
     */
    public function uploadProof(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $transaction->update([
                'payment_proof' => $path,
            ]);

            return redirect()->route('transactions.history')->with('success', 'Bukti pembayaran telah dikirim. Admin akan segera memverifikasi investasi Anda.');
        }

        return back()->with('error', 'Gagal mengunggah bukti pembayaran.');
    }

    /**
     * Redirect to Xendit Payment Gateway
     */
    public function payWithXendit(Transaction $transaction, \App\Services\XenditService $xenditService)
    {
        try {
            if ($transaction->user_id !== Auth::id()) {
                abort(403);
            }

            $invoice = $xenditService->createInvoice($transaction);

            if ($invoice['success']) {
                $transaction->update([
                    'payment_url' => $invoice['invoice_url']
                ]);

                return redirect($invoice['invoice_url']);
            }

            return redirect()->route('transactions.history')->with('error', 'Gagal membuat invoice Xendit: ' . ($invoice['error'] ?? 'Unknown Error'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Xendit Error: ' . $e->getMessage());
            return redirect()->route('transactions.history')->with('error', 'Xendit Error: ' . $e->getMessage());
        }
    }
}
