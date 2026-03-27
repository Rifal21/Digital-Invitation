<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of personal transactions.
     */
    public function index()
    {
        $transactions = Auth::user()->transactions()->with('package')->latest()->get();
        return view('transactions.history', compact('transactions'));
    }

    /**
     * Create a new transaction (the 'Buy' action from pricing).
     */
    public function store(Package $package)
    {
        // Cancel existing pending transactions for this package if any
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
        ]);

        return redirect()->route('transactions.checkout', $transaction)
            ->with('success', 'Pesanan berhasil dibuat. Silakan selesaikan pembayaran.');
    }

    /**
     * Show the checkout page (payment instructions).
     */
    public function checkout(Transaction $transaction)
    {
        // Ensure user owns this transaction
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        if ($transaction->status !== 'pending') {
            return redirect()->route('transactions.history')->with('warning', 'Transaksi ini sudah tidak dapat diubah.');
        }

        return view('transactions.checkout', compact('transaction'));
    }

    /**
     * Upload payment proof.
     */
    public function uploadProof(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|image|max:2048', // 2MB Max
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $transaction->update([
                'payment_proof' => $path,
            ]);

            return redirect()->route('dashboard')->with('success', 'Bukti pembayaran telah dikirim. Admin akan segera melakukan verifikasi.');
        }

        return back()->with('error', 'Gagal mengunggah bukti pembayaran.');
    }

    /**
     * Redirect to DOKU Payment Gateway
     */
    public function payWithDoku(Transaction $transaction, \App\Services\DokuService $dokuService)
    {
        try {
            if ($transaction->user_id !== Auth::id()) {
                abort(403);
            }

            $checkout = $dokuService->createCheckout($transaction);
            
            if (isset($checkout['response']['payment']['url'])) {
                return redirect($checkout['response']['payment']['url']);
            }

            return back()->with('error', 'Gagal membuat sesi pembayaran Doku: ' . ($checkout['message'] ?? 'Unknown Error'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Doku Error: ' . $e->getMessage());
            return back()->with('error', 'Doku Error: ' . $e->getMessage());
        }
    }
}
