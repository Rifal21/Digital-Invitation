<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     */
    public function index()
    {
        $transactions = Transaction::with(['user', 'package'])
            ->latest()
            ->paginate(10);
            
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Confirm a transaction as paid.
     */
    public function confirm(Transaction $transaction)
    {
        $transaction->update([
            'status' => 'paid',
            'confirmed_at' => now(),
        ]);

        return back()->with('success', 'Transaksi berhasil dikonfirmasi. User kini memiliki akses paket.');
    }

    /**
     * Cancel/Reject a transaction.
     */
    public function cancel(Transaction $transaction)
    {
        $transaction->update([
            'status' => 'cancelled',
        ]);

        return back()->with('warning', 'Transaksi telah dibatalkan.');
    }
}
