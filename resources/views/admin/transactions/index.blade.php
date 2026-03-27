<x-app-layout>
    <x-slot name="header">
        Log Transaksi Platform
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2.5rem] shadow-[0_30px_60px_rgba(0,0,0,0.02)] border border-slate-50 overflow-hidden" data-aos="fade-up">
                <div class="p-10 md:p-14">
                    
                    <div class="mb-10 flex justify-between items-end border-b border-slate-50 pb-6">
                        <div>
                             <span class="text-[9px] font-black text-indigo-500 uppercase tracking-[0.6em] mb-2 block">Financial Ops</span>
                             <h4 class="text-3xl font-serif font-black text-[#4D243D]">Daftar Transaksi</h4>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 border-b border-slate-50">
                                    <th class="px-6 py-6">Customer / Paket</th>
                                    <th class="px-6 py-6">Rincian Pembayaran</th>
                                    <th class="px-6 py-6">Bukti Bayar</th>
                                    <th class="px-6 py-6">Status</th>
                                    <th class="px-6 py-6">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($transactions as $trx)
                                    <tr class="group hover:bg-slate-50/50 transition duration-300">
                                        <td class="px-6 py-8">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-black text-[#4D243D] mb-1 italic">{{ $trx->user->name }}</span>
                                                <span class="text-[8px] font-black text-slate-300 uppercase tracking-widest">{{ $trx->package->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-8">
                                            <div class="space-y-1">
                                                <div class="flex justify-between w-32 border-b border-slate-50 pb-1">
                                                    <span class="text-[8px] font-black text-slate-300 uppercase">Subtotal</span>
                                                    <span class="text-[10px] font-bold text-slate-600 italic">Rp {{ number_format($trx->subtotal, 0, ',', '.') }}</span>
                                                </div>
                                                <div class="flex justify-between w-32 border-b border-slate-50 pb-1">
                                                    <span class="text-[8px] font-black text-slate-300 uppercase">Admin Fee</span>
                                                    <span class="text-[10px] font-bold text-slate-600 italic">Rp {{ number_format($trx->admin_fee, 0, ',', '.') }}</span>
                                                </div>
                                                <div class="flex justify-between w-32 pt-1">
                                                    <span class="text-[9px] font-black text-[#4D243D] uppercase">Total</span>
                                                    <span class="text-sm font-black text-rose-500 italic">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-8">
                                            @if($trx->payment_proof)
                                                <a href="{{ asset('storage/' . $trx->payment_proof) }}" target="_blank" class="w-12 h-12 rounded-xl border border-slate-100 p-1 bg-white shadow-sm flex items-center justify-center hover:scale-110 transition group">
                                                    <img src="{{ asset('storage/' . $trx->payment_proof) }}" class="w-full h-full object-cover rounded-lg group-hover:opacity-80 transition">
                                                </a>
                                            @else
                                                <span class="text-[8px] font-black text-slate-200 uppercase italic tracking-widest">Belum Upload</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-8">
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'bg-amber-50 text-amber-600',
                                                    'paid' => 'bg-emerald-50 text-emerald-600',
                                                    'cancelled' => 'bg-rose-50 text-rose-500'
                                                ];
                                            @endphp
                                            <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ $statusClasses[$trx->status] }}">
                                                {{ $trx->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-8">
                                            @if($trx->status == 'pending')
                                                <div class="flex gap-2">
                                                    <form method="POST" action="{{ route('admin.transactions.confirm', $trx) }}">
                                                        @csrf
                                                        <button class="w-10 h-10 bg-emerald-500 text-white rounded-xl shadow-lg shadow-emerald-500/10 hover:bg-emerald-600 transition active:scale-95 flex items-center justify-center">
                                                            <i class="fas fa-check text-xs"></i>
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="{{ route('admin.transactions.cancel', $trx) }}">
                                                        @csrf
                                                        <button class="w-10 h-10 bg-rose-500 text-white rounded-xl shadow-lg shadow-rose-500/10 hover:bg-rose-600 transition active:scale-95 flex items-center justify-center">
                                                            <i class="fas fa-times text-xs"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-[9px] font-black text-slate-200 uppercase italic tracking-widest">{{ $trx->confirmed_at ? 'Fixed at ' . $trx->confirmed_at->format('d/m/Y') : '-' }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-20 text-center">
                                            <i class="fas fa-receipt text-6xl text-slate-100 mb-6 italic"></i>
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em]">Belum ada data transaksi masuk</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                        <div class="mt-10">
                            {{ $transactions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
