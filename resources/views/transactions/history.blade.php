<x-app-layout>
    <x-slot name="header">
        Riwayat Pesanan
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white rounded-[2rem] md:rounded-[2.5rem] shadow-[0_30px_60px_rgba(0,0,0,0.02)] border border-slate-50 overflow-hidden"
                data-aos="fade-up">
                <div class="p-6 md:p-14 text-gray-900">

                    <div class="mb-8 md:mb-10 pb-6 border-b border-slate-50 flex justify-between items-end">
                        <div>
                            <span
                                class="text-[8px] md:text-[9px] font-black text-rose-500 uppercase tracking-[0.6em] mb-2 block">My
                                Transactions</span>
                            <h4 class="text-2xl md:text-3xl font-serif font-black text-[#0F172A]">Daftar Pesanan Saya
                            </h4>
                        </div>
                        <div class="hidden md:block">
                            <i class="fas fa-receipt text-3xl text-slate-100 italic"></i>
                        </div>
                    </div>

                    @if ($transactions->isEmpty())
                        <div class="py-20 text-center">
                            <i class="fas fa-receipt text-6xl text-slate-100 mb-6 italic"></i>
                            <p class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-[0.4em]">
                                Belum ada pesanan yang ditemukan</p>
                            <a href="{{ route('packages.index') }}"
                                class="mt-8 inline-block px-8 py-4 bg-[#0F172A] text-[#C5A267] rounded-2xl text-[9px] font-black uppercase tracking-widest shadow-xl hover:bg-slate-900 transition active:scale-95">Lihat
                                Paket</a>
                        </div>
                    @else
                        <!-- Desktop Table -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr
                                        class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 border-b border-slate-50 text-center">
                                        <th class="px-6 py-6 text-left">ID Transaksi</th>
                                        <th class="px-6 py-6 text-left">Produk / Paket</th>
                                        <th class="px-6 py-6">Rincian Bayar</th>
                                        <th class="px-6 py-6">Status Pembayaran</th>
                                        <th class="px-6 py-6">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @foreach ($transactions as $trx)
                                        <tr class="group hover:bg-slate-50/50 transition duration-300">
                                            <td class="px-6 py-8 text-left">
                                                {{-- <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest leading-none mb-1">TRX-</p> --}}
                                                <p class="text-xs font-bold text-[#0F172A] tracking-tighter">
                                                    {{ $trx->invoice_number }}</p>
                                            </td>
                                            <td class="px-6 py-8 text-left">
                                                <div class="flex flex-col">
                                                    <span
                                                        class="text-sm font-serif font-black text-[#0F172A] italic mb-1 uppercase tracking-tighter">{{ $trx->package->name }}</span>
                                                    <span
                                                        class="text-[8px] font-black text-slate-300 uppercase tracking-widest">{{ $trx->created_at->format('d M Y, H:i') }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-8 text-center text-xs">
                                                <div
                                                    class="inline-block p-4 rounded-2xl bg-slate-50 border border-slate-100 min-w-[180px]">
                                                    <div
                                                        class="flex justify-between items-center mb-2 pb-2 border-b border-slate-200/50">
                                                        <span
                                                            class="text-[8px] font-black text-slate-300 uppercase">Subtotal</span>
                                                        <span class="text-xs font-bold text-slate-500">Rp
                                                            {{ number_format($trx->subtotal, 0, ',', '.') }}</span>
                                                    </div>
                                                    <div class="flex justify-between items-end">
                                                        <span
                                                            class="text-[9px] font-black text-[#0F172A] uppercase tracking-widest">TOTAL</span>
                                                        <h5
                                                            class="text-lg font-serif font-black text-rose-500 italic tracking-tighter leading-none">
                                                            Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-8 text-center">
                                                @php
                                                    $statusClasses = [
                                                        'pending' => 'bg-amber-50 text-amber-600',
                                                        'paid' => 'bg-emerald-50 text-emerald-600',
                                                        'cancelled' => 'bg-rose-50 text-rose-500',
                                                    ];
                                                @endphp
                                                <span
                                                    class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ $statusClasses[$trx->status] }}">
                                                    {{ $trx->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-8 text-center">
                                                @if ($trx->status == 'pending')
                                                    <a href="{{ route('transactions.show', $trx) }}"
                                                        class="px-6 py-3 bg-[#0F172A] text-[#C5A267] rounded-xl text-[9px] font-black uppercase tracking-widest shadow-lg shadow-[#0F172A]/10 hover:bg-slate-900 transition duration-500 active:scale-95">Selesaikan</a>
                                                @else
                                                    <span
                                                        class="text-[9px] font-black text-slate-300 uppercase italic tracking-widest">Done</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile List (Card Layout) -->
                        <div class="md:hidden space-y-4">
                            @foreach ($transactions as $trx)
                                <div
                                    class="p-6 rounded-[2rem] bg-slate-50 border border-slate-100 shadow-sm relative overflow-hidden group active:bg-white transition duration-500">
                                    <div class="flex justify-between items-start mb-6">
                                        <div>
                                            <p
                                                class="text-[8px] font-black text-slate-300 uppercase tracking-widest mb-1 leading-none">
                                                TRX-{{ substr($trx->id, 0, 8) }}</p>
                                            <h5
                                                class="text-md font-serif font-black text-[#0F172A] uppercase tracking-tighter italic">
                                                {{ $trx->package->name }}</h5>
                                            <p class="text-[8px] font-bold text-slate-400 mt-0.5">
                                                {{ $trx->created_at->format('d M Y, H:i') }}</p>
                                        </div>
                                        <div
                                            class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest {{ $statusClasses[$trx->status] }} shadow-sm">
                                            {{ $trx->status }}
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-end mt-8 pt-4 border-t border-slate-200/50">
                                        <div>
                                            <p class="text-[8px] font-black text-slate-300 uppercase mb-0.5">Total Bayar
                                            </p>
                                            <h4 class="text-xl font-serif font-black text-rose-500 italic leading-none">
                                                Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</h4>
                                        </div>
                                        @if ($trx->status == 'pending')
                                            <a href="{{ route('transactions.show', $trx) }}"
                                                class="px-5 py-2.5 bg-[#0F172A] text-[#C5A267] rounded-xl text-[8px] font-black uppercase tracking-widest shadow-lg active:scale-95 transition">Selesaikan</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
