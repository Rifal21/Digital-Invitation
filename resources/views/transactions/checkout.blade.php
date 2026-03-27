<x-app-layout>
    <x-slot name="header">
        Selesaikan Pembayaran
    </x-slot>

    <!-- Select2 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container { width: 100% !important; }
        .select2-container--default .select2-selection--single {
            border-radius: 1.25rem !important; height: 50px !important; border: 1px solid #f1f5f9 !important;
            background-color: #f8fafc !important; display: flex !important; align-items: center !important;
            padding: 0 1rem !important; font-family: 'Inter', sans-serif !important; font-weight: 800 !important;
            font-size: 0.7rem !important; text-transform: uppercase !important; letter-spacing: 0.1em !important;
            color: #4D243D !important;
        }
    </style>

    <div class="py-4 md:py-12" x-data="{ mainTab: 'none', selectedMethodId: '' }">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 px-4">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-10 items-start">
                
                <!-- Right: Selection & Summary (Appears Top on Mobile) -->
                <div class="lg:col-span-1 space-y-4 md:space-y-8" data-aos="fade-left">
                    <div class="bg-white rounded-[2.5rem] md:rounded-[3rem] shadow-[0_40px_80px_rgba(0,0,0,0.02)] border border-slate-50 overflow-hidden sticky top-8">
                        <div class="p-8 md:p-10">
                            
                            <!-- Bill Detail (Header) -->
                            <div class="mb-8 p-6 rounded-[2rem] bg-[#4D243D] text-white shadow-xl relative overflow-hidden group">
                                <div class="absolute -top-4 -right-4 w-12 h-12 bg-white/10 rounded-full blur-xl group-hover:scale-150 transition duration-700"></div>
                                <div class="flex items-center gap-4">
                                     <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-[#EDD4B2]">
                                         <i class="fas fa-gem text-xs"></i>
                                     </div>
                                     <div>
                                         <p class="text-[7px] font-black uppercase tracking-widest opacity-50 mb-0.5">Total Tagihan:</p>
                                         <h4 class="text-xl md:text-2xl font-serif font-black italic tracking-tighter leading-none">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</h4>
                                     </div>
                                </div>
                            </div>

                            <!-- Channel Selector (The requested split) -->
                            <div class="space-y-3 mb-10">
                                <h6 class="text-[8px] font-black text-slate-300 uppercase tracking-[0.3em] mb-4">Pilih Jalur Pembayaran:</h6>
                                
                                <!-- Auto Selector -->
                                <button @click="mainTab = 'auto'; selectedMethodId = ''" 
                                    :class="mainTab === 'auto' ? 'border-[#4D243D] bg-[#FDF8F0] shadow-lg ring-1 ring-amber-100' : 'border-slate-50 hover:bg-slate-50 opacity-60 text-slate-400'"
                                    class="w-full p-4 rounded-2xl border-2 transition-all duration-300 flex items-center justify-between group">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs" :class="mainTab === 'auto' ? 'bg-[#4D243D] text-[#EDD4B2]' : 'bg-slate-100 text-slate-300 group-hover:bg-[#4D243D] group-hover:text-white transition duration-500'">
                                            <i class="fas fa-bolt"></i>
                                        </div>
                                        <div class="text-left">
                                            <span class="text-[10px] font-black uppercase text-[#4D243D] block tracking-tighter">Otomatis / Gate</span>
                                            <span class="text-[7px] font-bold text-slate-400 block -mt-1 uppercase italic tracking-widest">Instant Activation</span>
                                        </div>
                                    </div>
                                    <i x-show="mainTab === 'auto'" class="fas fa-check-circle text-emerald-500 text-sm"></i>
                                </button>

                                <!-- Manual Selector -->
                                <button @click="mainTab = 'manual'; selectedMethodId = ''" 
                                    :class="mainTab === 'manual' ? 'border-[#4D243D] bg-[#FDF8F0] shadow-lg ring-1 ring-amber-100' : 'border-slate-50 hover:bg-slate-50 opacity-60 text-slate-400'"
                                    class="w-full p-4 rounded-2xl border-2 transition-all duration-300 flex items-center justify-between group">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs" :class="mainTab === 'manual' ? 'bg-[#4D243D] text-[#EDD4B2]' : 'bg-slate-100 text-slate-300 group-hover:bg-[#4D243D] group-hover:text-white transition duration-500'">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <div class="text-left">
                                            <span class="text-[10px] font-black uppercase text-[#4D243D] block tracking-tighter">Transfer Manual</span>
                                            <span class="text-[7px] font-bold text-slate-400 block -mt-1 uppercase italic tracking-widest">Upload Bukti Bayar</span>
                                        </div>
                                    </div>
                                    <i x-show="mainTab === 'manual'" class="fas fa-check-circle text-amber-500 text-sm"></i>
                                </button>
                            </div>

                            <!-- Cost Breakdown -->
                            <div class="space-y-4 pt-6 border-t border-slate-50">
                                <div class="flex justify-between items-center text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                    <span>Subtotal</span>
                                    <span class="text-[#4D243D]">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                    <span>Admin Fee</span>
                                    <span class="text-[#4D243D]">Rp {{ number_format($transaction->admin_fee, 0, ',', '.') }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Left: Interactive Payment Engine (Bottom on Mobile) -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-[2rem] md:rounded-[3rem] shadow-[0_40px_80px_rgba(0,0,0,0.02)] border border-slate-50 overflow-hidden min-h-[400px]" data-aos="fade-up">
                        
                        <!-- Case: Automated (DOKU) -->
                        <div x-show="mainTab === 'auto'" x-transition:enter="transition ease-out duration-500 transform opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="p-10 md:p-14 text-center">
                             <div class="max-w-md mx-auto space-y-10 py-10 md:py-20">
                                  <img src="https://static.doku.com/jokul/images/logo-doku.png" class="h-16 md:h-20 mx-auto opacity-30 hover:opacity-100 transition duration-1000 grayscale hover:grayscale-0">
                                  <div class="space-y-5">
                                       <h4 class="text-2xl font-serif font-black text-[#4D243D] italic uppercase tracking-tighter shadow-sm">Konfirmasi Instan</h4>
                                       <p class="text-xs text-slate-500 leading-relaxed italic opacity-80">Gunakan integrasi gateway DOKU untuk pembayaran real-time. Paket Anda akan aktif secara **otomatis** segera setelah transaksi selesai tanpa verifikasi admin.</p>
                                  </div>
                                  <a href="{{ route('transactions.doku.pay', $transaction) }}" class="inline-flex w-full py-6 rounded-2xl bg-[#4D243D] text-[#EDD4B2] font-black text-xs uppercase tracking-[0.4em] shadow-2xl hover:bg-slate-900 transition-all duration-500 active:scale-95 items-center justify-center gap-4">
                                       <span>Bayar Sekarang (DOKU)</span>
                                       <i class="fas fa-shield-check text-[10px]"></i>
                                  </a>
                             </div>
                        </div>

                        <!-- Case: Manual Transfer -->
                        <div x-show="mainTab === 'manual'" x-transition:enter="transition ease-out duration-500 transform opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="divide-y divide-slate-50">
                             <!-- Bank Select -->
                             <div class="p-8 md:p-14 space-y-8">
                                  <div class="flex items-center gap-4">
                                       <div class="w-1 h-6 bg-[#EDD4B2] rounded-full"></div>
                                       <h4 class="text-xl md:text-2xl font-serif font-black text-[#4D243D] italic">Instruksi Transfer</h4>
                                  </div>
                                  <select id="m_payment_select" class="w-full">
                                       <option value="" disabled selected>Pilih Bank Tujuan...</option>
                                       @foreach(\App\Models\PaymentMethod::where('is_active', true)->where('name', 'NOT LIKE', '%DOKU%')->get() as $method)
                                           <option value="{{ $method->id }}">{{ $method->name }}</option>
                                       @endforeach
                                  </select>

                                  <!-- Manual Card -->
                                  <div x-show="selectedMethodId" x-transition:enter="transition ease-out duration-300 transform opacity-0 scale-95" class="mt-8">
                                       @foreach(\App\Models\PaymentMethod::where('is_active', true)->where('name', 'NOT LIKE', '%DOKU%')->get() as $method)
                                            <template x-if="selectedMethodId == '{{ $method->id }}'">
                                                 <div class="p-8 rounded-[2.5rem] bg-indigo-50/20 border border-indigo-100/30 backdrop-blur-sm relative overflow-hidden group">
                                                      <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                                                           <div class="space-y-6">
                                                                <div class="flex items-center gap-4">
                                                                     <div class="w-10 h-10 bg-[#4D243D] rounded-xl flex items-center justify-center text-[#EDD4B2] shadow-xl">
                                                                          <i class="fas {{ $method->qr_image ? 'fa-qrcode' : 'fa-university' }} text-sm"></i>
                                                                     </div>
                                                                     <h4 class="text-xl font-serif font-black text-[#4D243D] italic uppercase tracking-tighter leading-none">{{ $method->name }}</h4>
                                                                </div>
                                                                <div class="bg-white/60 p-5 rounded-[1.5rem] border border-white">
                                                                     <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">ID / Rekening</p>
                                                                     <p class="text-2xl font-black text-[#4D243D] tracking-tighter mb-1">{{ $method->account_number }}</p>
                                                                     <p class="text-[9px] font-black text-indigo-600 uppercase tracking-widest italic opacity-60">a.n {{ $method->account_name }}</p>
                                                                </div>
                                                           </div>
                                                           @if($method->qr_image)
                                                                <div class="flex flex-col items-center">
                                                                     <div class="p-4 bg-white rounded-3xl shadow-xl border border-slate-100">
                                                                          <img src="{{ asset('storage/' . $method->qr_image) }}" class="w-32 h-32 md:w-36 md:h-36 object-contain rounded-xl">
                                                                     </div>
                                                                     <p class="mt-4 text-[7px] font-black text-slate-300 uppercase tracking-widest italic">Pindai QRis Instan</p>
                                                                </div>
                                                           @endif
                                                      </div>
                                                 </div>
                                            </template>
                                       @endforeach
                                  </div>
                             </div>

                             <!-- Proof Upload -->
                             <div x-show="selectedMethodId" x-transition class="p-8 md:p-14 bg-slate-50/20 space-y-8">
                                  <div class="flex items-center gap-4 text-[#4D243D]">
                                       <i class="fas fa-cloud-upload-alt text-lg"></i>
                                       <h4 class="text-lg md:text-xl font-serif font-black italic">Unggah Bukti Transaksi</h4>
                                  </div>
                                  <form method="POST" action="{{ route('transactions.upload', $transaction) }}" enctype="multipart/form-data" class="space-y-6">
                                       @csrf
                                       <label for="p_proof_m" class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-slate-200 rounded-[2rem] hover:border-[#4D243D]/20 hover:bg-white transition duration-500 cursor-pointer p-6 shadow-inner group">
                                            <i class="fas fa-camera-retro text-2xl text-slate-200 mb-2 group-hover:text-[#4D243D]/30 transition"></i>
                                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Lampirkan Bukti Transfer</p>
                                            <input type="file" id="p_proof_m" name="payment_proof" class="hidden" onchange="previewFM(this)" accept="image/*" required>
                                            <div id="f-name-m" class="hidden mt-4 text-[9px] font-black text-emerald-500 italic px-4 py-1.5 rounded-full bg-emerald-50 border border-emerald-100 tracking-tighter uppercase"></div>
                                       </label>
                                       <button type="submit" class="w-full py-5 rounded-2xl bg-[#4D243D] text-[#EDD4B2] font-black text-[10px] uppercase tracking-[0.4em] shadow-xl hover:bg-slate-900 transition-all duration-500 active:scale-95 items-center justify-center flex gap-4">
                                            <span>Konfirmasi Manual</span>
                                            <i class="fas fa-paper-plane text-[9px]"></i>
                                       </button>
                                  </form>
                             </div>
                        </div>

                        <!-- Empty Case (Landing) -->
                        <div x-show="mainTab === 'none'" class="h-[400px] flex items-center justify-center p-14 text-center">
                             <div class="space-y-6 max-w-xs">
                                  <div class="w-20 h-20 bg-slate-50 rounded-[2.5rem] flex items-center justify-center mx-auto text-slate-200 text-3xl">
                                       <i class="fas fa-lock"></i>
                                  </div>
                                  <h4 class="text-sm font-black text-slate-300 uppercase tracking-[0.4em]">Silakan pilih jalur pembayaran Anda pada Ringkasan Pesanan</h4>
                             </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Assets -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            const $m = $('#m_payment_select');
            $m.select2({ placeholder: "Pilih Tujuan Transfer..." });
            $m.on('change', function(e) {
                const el = document.querySelector('[x-data]');
                if (el) el.__x.$data.selectedMethodId = e.target.value;
            });
        });
        function previewFM(i) {
            const f = i.files[0] ? i.files[0].name : '';
            const d = document.getElementById('f-name-m');
            if (f) { d.innerText = "OK: " + f; d.classList.remove('hidden'); }
        }
    </script>
</x-app-layout>
