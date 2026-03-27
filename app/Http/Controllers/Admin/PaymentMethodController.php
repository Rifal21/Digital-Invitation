<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $methods = PaymentMethod::all();
        return view('admin.payment-methods.index', compact('methods'));
    }

    public function create()
    {
        return view('admin.payment-methods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'qr_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('qr_image')) {
            $data['qr_image'] = $request->file('qr_image')->store('qris', 'public');
        }

        PaymentMethod::create($data);
        return redirect()->route('admin.payment-methods.index')->with('success', 'Metode pembayaran berhasil ditambahkan.');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $request->validate([
            'name' => 'required',
            'qr_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('qr_image')) {
            // Delete old QR if exists
            if ($paymentMethod->qr_image) {
                Storage::disk('public')->delete($paymentMethod->qr_image);
            }
            $data['qr_image'] = $request->file('qr_image')->store('qris', 'public');
        } else {
            // Preserve old if not changing
            unset($data['qr_image']);
        }

        $paymentMethod->update($data);
        return redirect()->route('admin.payment-methods.index')->with('success', 'Metode pembayaran berhasil diperbarui.');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->qr_image) {
            Storage::disk('public')->delete($paymentMethod->qr_image);
        }
        $paymentMethod->delete();
        return back()->with('warning', 'Metode pembayaran telah dihapus.');
    }

    public function toggle(PaymentMethod $paymentMethod)
    {
        $paymentMethod->update(['is_active' => !$paymentMethod->is_active]);
        return back()->with('success', 'Status metode pembayaran diperbarui.');
    }
}
