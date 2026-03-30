<x-app-layout>
    <x-slot name="header">
        Tinjauan Investasi
    </x-slot>

    <!-- Select2 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            border-radius: 1.25rem !important;
            height: 55px !important;
            border: 1px solid #e2e8f0 !important;
            background-color: #ffffff !important;
            display: flex !important;
            align-items: center !important;
            padding: 0 1rem !important;
            transition: all 0.3s ease !important;
        }
        .select2-dropdown { border-radius: 1.25rem !important; border: 1px solid #e2e8f0 !important; overflow: hidden; }
    </style>

    <div class="py-4 md:py-12" x-data="{ 
        payment_type: 'auto', 
        manual_method_id: '', 
        confirming: false,
        showSummary: window.innerWidth > 768
    }">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-12">
            <!-- Breadcrumb / Progress (Optional but Premium) -->
            <div class="hidden md:flex items-center gap-4 mb-10 text-[10px] font-black uppercase tracking-[0.4em] text-slate-300">
                <span class="text-[#C5A267]">01 Review</span>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="opacity-50">02 Payment</span>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="opacity-50">03 Activation</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-start">

                <!-- 🚀 Left: Payment Selection & Forms (Col 7/12) -->
                <div class="lg:col-span-7 order-2 lg:order-1 space-y-8" data-aos="fade-up">
                    <div class="bg-white rounded-[2.5rem] shadow-[0_40px_100px_rgba(15,23,42,0.03)] border border-slate-100 p-8 md:p-12">
                        <div class="flex items-center justify-between mb-10">
                            <h4 class="text-[11px] font-black text-[#0F172A] uppercase tracking-[0.4em]">Metode Pembayaran</h4>
                            <div class="w-10 h-1 bg-[#C5A267]/20 rounded-full"></div>
                        </div>

                        <form id="checkout-form" action="{{ route('transactions.store', ['package' => $package->id, 'invitation' => $invitation->id]) }}" method="POST" @submit="confirming = true">
                            @csrf
                            <input type="hidden" name="payment_type" :value="payment_type">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
                                <!-- Auto Option -->
                                <button type="button" @click="payment_type = 'auto'"
                                    :class="payment_type === 'auto' ? 'border-[#0F172A] bg-slate-50 ring-1 ring-[#C5A267]/20' : 'border-slate-100 opacity-60 hover:opacity-100'"
                                    class="relative p-6 rounded-[2rem] border-2 transition-all duration-500 text-left group overflow-hidden">
                                    <div x-show="payment_type === 'auto'" class="absolute top-0 right-0 p-4" x-cloak>
                                        <i class="fas fa-check-circle text-emerald-500"></i>
                                    </div>
                                    <div class="w-12 h-12 rounded-2xl bg-[#0F172A] text-[#C5A267] flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition duration-500">
                                        <i class="fas fa-bolt text-lg"></i>
                                    </div>
                                    <span class="text-[12px] font-black uppercase text-[#0F172A] block tracking-tighter mb-1">Otomatis</span>
                                    <span class="text-[9px] font-bold text-slate-400 block uppercase tracking-widest italic">Aktivasi Instan</span>
                                </button>

                                <!-- Manual Option -->
                                <button type="button" @click="payment_type = 'manual'"
                                    :class="payment_type === 'manual' ? 'border-[#0F172A] bg-slate-50 ring-1 ring-[#C5A267]/20' : 'border-slate-100 opacity-60 hover:opacity-100'"
                                    class="relative p-6 rounded-[2rem] border-2 transition-all duration-500 text-left group overflow-hidden">
                                    <div x-show="payment_type === 'manual'" class="absolute top-0 right-0 p-4" x-cloak>
                                        <i class="fas fa-check-circle text-amber-500"></i>
                                    </div>
                                    <div class="w-12 h-12 rounded-2xl bg-white border border-slate-100 text-slate-400 flex items-center justify-center mb-6 shadow-sm group-hover:bg-[#0F172A] group-hover:text-[#C5A267] transition duration-500">
                                        <i class="fas fa-university text-lg"></i>
                                    </div>
                                    <span class="text-[12px] font-black uppercase text-[#0F172A] block tracking-tighter mb-1">Transfer Manual</span>
                                    <span class="text-[9px] font-bold text-slate-400 block uppercase tracking-widest italic">Verifikasi Manual</span>
                                </button>
                            </div>

                            <!-- Manual Bank Detail Expansion -->
                            <div x-show="payment_type === 'manual'" x-transition:enter="transition ease-out duration-500 transform opacity-0 -translate-y-4" x-cloak class="space-y-8 mb-10">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-2">Pilih Bank Tujuan</label>
                                    <select name="payment_method_id" id="manual_bank_select" class="w-full" :required="payment_type === 'manual'">
                                        <option value="" disabled selected>Select Masterpiece Bank...</option>
                                        @foreach (\App\Models\PaymentMethod::where('is_active', true)->where('name', 'NOT LIKE', '%DOKU%')->get() as $method)
                                            <option value="{{ $method->id }}">{{ $method->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div x-show="manual_method_id" x-transition:enter="transition ease-out duration-500 transform opacity-0 scale-95" class="bg-slate-50 rounded-[2.5rem] p-8 border border-slate-100">
                                    @foreach (\App\Models\PaymentMethod::where('is_active', true)->where('name', 'NOT LIKE', '%DOKU%')->get() as $method)
                                        <div x-show="manual_method_id == '{{ $method->id }}'" class="space-y-6">
                                            <div class="flex items-center justify-between border-b border-slate-200/50 pb-6">
                                                <div class="flex items-center gap-4">
                                                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#0F172A] shadow-sm">
                                                        <i class="fas {{ $method->qr_image ? 'fa-qrcode' : 'fa-building-columns' }}"></i>
                                                    </div>
                                                    <div>
                                                        <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest leading-none mb-1">Account Target</p>
                                                        <h5 class="text-[11px] font-black text-[#0F172A] uppercase tracking-tighter italic">{{ $method->name }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div class="space-y-2">
                                                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Nomor Rekening</p>
                                                    <div class="bg-white p-4 rounded-2xl flex items-center justify-between border border-slate-100 lg:group-hover:border-[#C5A267]/20 transition">
                                                        <span class="text-sm font-black text-[#0F172A] tracking-tighter">{{ $method->account_number }}</span>
                                                        <button type="button" @click="navigator.clipboard.writeText('{{ $method->account_number }}'); Toast.fire({ icon: 'success', title: 'Copied to legacy' })" class="text-slate-300 hover:text-[#C5A267] transition">
                                                            <i class="far fa-copy"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="space-y-2">
                                                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Atas Nama</p>
                                                    <div class="bg-white p-4 rounded-2xl border border-slate-100 h-[62px] flex items-center">
                                                        <span class="text-[11px] font-black text-[#0F172A] uppercase tracking-tighter truncate">{{ $method->account_name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($method->qr_image)
                                                <div class="pt-4 flex justify-center">
                                                    <div class="p-4 bg-white rounded-[2rem] shadow-sm border border-slate-100">
                                                        <img src="{{ asset('storage/' . $method->qr_image) }}" class="w-40 h-40 object-contain">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Total Summary (Desktop) -->
                            <div class="hidden md:block p-8 rounded-[2.5rem] bg-[#0F172A] text-white overflow-hidden relative group">
                                <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                                <div class="relative z-10 flex items-center justify-between">
                                    <div>
                                        <p class="text-[8px] font-black uppercase tracking-[0.6em] text-[#C5A267] leading-none mb-3">Total Investasi</p>
                                        <h3 class="font-serif text-3xl font-black tracking-tighter italic">IDR {{ number_format($total, 0, ',', '.') }}</h3>
                                    </div>
                                    <button type="submit" :disabled="confirming" class="px-10 py-5 bg-[#C5A267] text-[#0F172A] rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] hover:scale-105 active:scale-95 transition-all shadow-xl">
                                        <span x-show="!confirming">Bayar Sekarang</span>
                                        <i x-show="confirming" class="fas fa-circle-notch animate-spin" x-cloak></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- 🏺 Right: Order Summary (Col 5/12) -->
                <div class="lg:col-span-5 order-1 lg:order-2" data-aos="fade-left">
                    <div class="bg-white rounded-[2.5rem] shadow-[0_40px_100px_rgba(15,23,42,0.02)] border border-slate-100 overflow-hidden sticky top-32">
                        <!-- Mobile Accordion Trigger -->
                        <button @click="showSummary = !showSummary" class="w-full md:hidden p-6 bg-[#0F172A] text-white flex items-center justify-between outline-none">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-shopping-bag text-[#C5A267]"></i>
                                <span class="text-[10px] font-black uppercase tracking-widest">{{ $package->name }} Package</span>
                            </div>
                            <i class="fas transition-transform duration-500" :class="showSummary ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </button>

                        <div x-show="showSummary" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 -translate-y-4" class="p-8 md:p-10 space-y-10">
                            <!-- Package Header (Desktop) -->
                            <div class="hidden md:block bg-gradient-to-br from-[#0F172A] to-[#241B35] -m-10 mb-10 p-10 text-white relative overflow-hidden">
                                <span class="text-[8px] font-black uppercase tracking-[0.6em] text-[#C5A267]/60 mb-2 block">Your Exclusive Access</span>
                                <h2 class="font-serif text-4xl font-black italic tracking-tighter">{{ $package->name }}</h2>
                            </div>

                            <div class="space-y-6">
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] flex items-center gap-3">
                                    Fitur Unggulan <div class="flex-1 h-px bg-slate-50"></div>
                                </h4>
                                <ul class="grid grid-cols-1 gap-4">
                                    @foreach (collect($package->features)->take(6) as $feature)
                                        <li class="flex items-start gap-4 text-[12px] font-medium text-slate-600">
                                            <div class="mt-1 w-5 h-5 rounded-lg bg-emerald-50 border border-emerald-100 flex items-center justify-center shrink-0">
                                                <i class="fas fa-check text-[8px] text-emerald-500"></i>
                                            </div>
                                            <span class="first-letter:uppercase leading-relaxed italic opacity-80">{{ strtolower($feature) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="px-8 py-6 space-y-4">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-400">Total Tamu:</span>
                                <span class="text-[#0F172A] font-black">{{ $guestCount }} Tamu</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-400">Limit Paket:</span>
                                <span class="text-[#0F172A] font-black">{{ $package->max_guests ?? 'Unlimited' }} Tamu</span>
                            </div>

                            <div class="h-px bg-slate-100 my-4"></div>

                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-400">Harga Dasar:</span>
                                <span class="text-[#0F172A] font-black">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                            </div>
                            
                            @if($surcharge > 0)
                            <div class="flex justify-between items-center text-sm text-amber-600">
                                <span class="font-medium italic text-xs">Biaya Tambahan Tamu:</span>
                                <span class="font-black">+ Rp {{ number_format($surcharge, 0, ',', '.') }}</span>
                            </div>
                            @endif

                             <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-400">Biaya Admin:</span>
                                <span class="text-[#0F172A] font-black">Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        </div>

                        <!-- Price summary (Visible on both desktop summary inside, or mobile separate) -->
                        <div class="hidden md:block bg-slate-50 p-6 text-center border-t border-slate-100">
                             <p class="text-[8px] font-black uppercase tracking-[0.4em] text-slate-300">Konfirmasi Final</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 📱 Mobile Floating Bottom Bar -->
        <div class="md:hidden fixed bottom-0 left-0 right-0 z-[100] bg-[#0F172A]/90 backdrop-blur-2xl border-t border-white/10 p-6 flex items-center justify-between">
            <div class="flex flex-col">
                <span class="text-[8px] font-black uppercase tracking-[0.4em] text-[#C5A267]/60 leading-none mb-2">Total Investasi</span>
                <span class="text-xl font-serif font-black italic text-white leading-none">IDR {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <button type="submit" form="checkout-form" :disabled="confirming" 
                    class="bg-[#C5A267] text-[#0F172A] px-10 py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] active:scale-95 shadow-2xl transition-all">
                <span x-show="!confirming">Bayar</span>
                <i x-show="confirming" class="fas fa-circle-notch animate-spin" x-cloak></i>
            </button>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                const $m = $('#manual_bank_select');
                $m.select2({
                    placeholder: "Pilih Bank Tujuan..."
                });

                $m.on('change', function(e) {
                    const alpineEl = document.querySelector('[x-data]');
                    if (alpineEl && alpineEl.__x) {
                        alpineEl.__x.$data.manual_method_id = e.target.value;
                    } else if (alpineEl && alpineEl._x_dataStack) {
                        alpineEl._x_dataStack[0].manual_method_id = e.target.value;
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>

