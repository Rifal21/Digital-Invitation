<x-app-layout>
    <x-slot name="header">
        Tinjauan Investasi Mahakarya
    </x-slot>

    <!-- Select2 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            border-radius: 1.25rem !important; height: 55px !important; border: 1px solid #e2e8f0 !important;
            background-color: #ffffff !important; display: flex !important; align-items: center !important;
            padding: 0 1rem !important; transition: all 0.3s ease !important;
        }
    </style>

    <div class="py-4 md:py-8" x-data="{ payment_type: 'auto', manual_method_id: '', confirming: false }">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-10 items-start">
                
                <!-- 🏺 Left: Detailed Review (Col 2/3) -->
                <div class="lg:col-span-2 space-y-6" data-aos="fade-right">
                    <div class="bg-white rounded-[2.5rem] shadow-[0_40px_80px_rgba(0,0,0,0.02)] border border-slate-100 overflow-hidden">
                        <!-- Package Header -->
                        <div class="p-8 md:p-12 bg-gradient-to-br from-[#4D243D] to-[#2D1424] text-white relative overflow-hidden group">
                             <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-3xl group-hover:scale-150 transition duration-1000"></div>
                             <div class="relative z-10 text-center md:text-left">
                                 <span class="text-[8px] font-black uppercase tracking-[0.5em] text-[#EDD4B2] opacity-60 block mb-4">Investment Collection</span>
                                 <h2 class="font-serif text-3xl md:text-5xl font-black italic tracking-tighter leading-tight">{{ $package->name }}</h2>
                             </div>
                        </div>

                        <!-- Feature Review -->
                        <div class="p-8 md:p-12 space-y-10">
                            <div>
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-8 border-b border-slate-50 pb-4 text-center md:text-left">Masterpiece Detail:</h4>
                                <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                                    @foreach(collect($package->features)->take(6) as $feature)
                                        <li class="flex items-start gap-4 text-[12px] font-medium text-slate-600">
                                            <div class="mt-1 w-5 h-5 rounded-lg bg-emerald-50 border border-emerald-100 flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-check text-[8px] text-emerald-500"></i>
                                            </div>
                                            <span class="first-letter:uppercase leading-relaxed">{{ strtolower($feature) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Price Split -->
                            <div class="pt-10 border-t border-slate-100 space-y-4">
                                <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest text-slate-400">
                                    <span>Subtotal</span>
                                    <span class="text-slate-900">IDR {{ number_format($package->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest text-slate-400">
                                    <span>Biaya Layanan & Pajak</span>
                                    <span class="text-slate-900">IDR {{ number_format($adminFee, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 🚀 Right: Payment Selection (Col 1/3) -->
                <div class="lg:col-span-1 space-y-6 sticky top-28" data-aos="fade-left">
                    <div class="bg-white rounded-[2.5rem] shadow-[0_40px_80px_rgba(0,0,0,0.02)] border border-slate-100 p-8 md:p-10">
                        <h4 class="text-[10px] font-black text-[#4D243D] uppercase tracking-[0.3em] mb-8">Pilih Jalur:</h4>
                        
                        <form action="{{ route('transactions.store', $package) }}" method="POST" @submit="confirming = true">
                            @csrf
                            <input type="hidden" name="payment_type" :value="payment_type">

                            <div class="space-y-4 mb-8">
                                <div @click="payment_type = 'auto'" 
                                    :class="payment_type === 'auto' ? 'border-[#4D243D] bg-[#FDF8F0] ring-1 ring-[#EDD4B2]/30 active' : 'border-slate-50 hover:border-slate-200'"
                                    class="p-5 rounded-2xl border-2 transition-all duration-300 cursor-pointer flex items-center justify-between group">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-[#4D243D] text-[#EDD4B2] flex items-center justify-center text-xs shadow-lg group-hover:scale-110 transition">
                                            <i class="fas fa-bolt"></i>
                                        </div>
                                        <div>
                                            <span class="text-[11px] font-black uppercase text-[#4D243D] block tracking-tighter">Otomatis (Doku)</span>
                                            <span class="text-[8px] font-bold text-slate-400 block -mt-1 uppercase tracking-widest italic leading-none">Aktivasi Instan</span>
                                        </div>
                                    </div>
                                    <i x-show="payment_type === 'auto'" class="fas fa-check-circle text-emerald-500 text-sm"></i>
                                </div>

                                <div @click="payment_type = 'manual'" 
                                    :class="payment_type === 'manual' ? 'border-[#4D243D] bg-[#FDF8F0] ring-1 ring-[#EDD4B2]/30 active' : 'border-slate-50 hover:border-slate-200'"
                                    class="p-5 rounded-2xl border-2 transition-all duration-300 cursor-pointer flex items-center justify-between group">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center text-xs group-hover:bg-[#4D243D] group-hover:text-[#EDD4B2] transition">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <div>
                                            <span class="text-[11px] font-black uppercase text-[#4D243D] block tracking-tighter">Transfer Manual</span>
                                            <span class="text-[8px] font-bold text-slate-400 block -mt-1 uppercase tracking-widest italic leading-none">Verifikasi Admin</span>
                                        </div>
                                    </div>
                                    <i x-show="payment_type === 'manual'" class="fas fa-check-circle text-amber-500 text-sm"></i>
                                </div>
                            </div>

                            <!-- Manual Bank Selector & Detail Card -->
                            <div x-show="payment_type === 'manual'" x-transition x-cloak class="mb-10 space-y-6">
                                <div>
                                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest block ml-2 mb-2">Tujuan Transfer:</label>
                                    <select name="payment_method_id" id="manual_bank_select" class="w-full" :required="payment_type === 'manual'">
                                        <option value="" disabled selected>Pilih Bank...</option>
                                        @foreach(\App\Models\PaymentMethod::where('is_active', true)->where('name', 'NOT LIKE', '%DOKU%')->get() as $method)
                                            <option value="{{ $method->id }}">{{ $method->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- 🏛️ The Bank Detail Reveal -->
                                <div x-show="manual_method_id" x-transition:enter="transition ease-out duration-300 transform opacity-0 scale-95" class="space-y-4">
                                    @foreach(\App\Models\PaymentMethod::where('is_active', true)->where('name', 'NOT LIKE', '%DOKU%')->get() as $method)
                                        <div x-show="manual_method_id == '{{ $method->id }}'" class="p-6 rounded-3xl bg-slate-50 border border-slate-100 shadow-inner group">
                                            <div class="flex items-center justify-between mb-6">
                                                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-[#4D243D] text-[10px] shadow-sm">
                                                    <i class="fas {{ $method->qr_image ? 'fa-qrcode' : 'fa-building-columns' }}"></i>
                                                </div>
                                                <span class="text-[8px] font-black uppercase tracking-[0.3em] text-slate-300">Bank Detail</span>
                                            </div>
                                            <div class="space-y-4">
                                                <div>
                                                    <p class="text-[7px] font-black text-slate-400 uppercase tracking-widest mb-1">Nomor Rekening</p>
                                                    <div class="flex items-center justify-between bg-white p-3 rounded-xl border border-slate-100">
                                                        <span class="text-xs font-black text-[#4D243D] tracking-tighter">{{ $method->account_number }}</span>
                                                        <button type="button" @click="navigator.clipboard.writeText('{{ $method->account_number }}'); Toast.fire({ icon: 'success', title: 'Nomor Rekening Disalin' })" class="text-slate-300 hover:text-gold transition">
                                                            <i class="far fa-copy text-[10px]"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="text-[7px] font-black text-slate-400 uppercase tracking-widest mb-1">Atas Nama</p>
                                                    <p class="text-[10px] font-black text-[#4D243D] italic uppercase tracking-tighter">{{ $method->account_name }}</p>
                                                </div>
                                                @if($method->qr_image)
                                                    <div class="pt-4 flex justify-center">
                                                        <div class="p-3 bg-white rounded-2xl shadow-sm border border-slate-100">
                                                            <img src="{{ asset('storage/' . $method->qr_image) }}" class="w-24 h-24 object-contain">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Final Price Display -->
                            <div class="mb-8 p-6 rounded-2xl bg-slate-50 border border-slate-100 text-center">
                                 <p class="text-[8px] font-black uppercase tracking-[0.4em] text-slate-400 mb-2">Total Investasi</p>
                                 <h3 class="font-serif text-3xl font-black text-[#4D243D] tracking-tighter leading-none italic">IDR {{ number_format($total, 0, ',', '.') }}</h3>
                            </div>

                            <button type="submit" :disabled="confirming" class="w-full py-5 rounded-2xl bg-[#4D243D] text-[#EDD4B2] font-black text-[11px] uppercase tracking-[0.4em] shadow-xl hover:bg-slate-900 transition-all duration-500 active:scale-95 disabled:opacity-50">
                                <span x-show="!confirming" class="flex items-center justify-center gap-4">
                                     <span x-text="payment_type === 'auto' ? 'Mulai Pembayaran' : 'Konfirmasi Pesanan'"></span>
                                     <i class="fas fa-chevron-right text-[9px]"></i>
                                </span>
                                <span x-show="confirming" x-cloak class="flex items-center justify-center gap-4">
                                    <i class="fas fa-circle-notch animate-spin"></i>
                                    <span>Memproses...</span>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            const $m = $('#manual_bank_select');
            $m.select2({ placeholder: "Pilih Bank Tujuan..." });
            
            // Critical: Bridge Select2 change to Alpine state
            $m.on('change', function(e) {
                const alpineEl = document.querySelector('[x-data]');
                if (alpineEl && alpineEl.__x) {
                    alpineEl.__x.$data.manual_method_id = e.target.value;
                } else if (alpineEl && alpineEl._x_dataStack) { // Handle Alpine v3
                    alpineEl._x_dataStack[0].manual_method_id = e.target.value;
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
