<x-app-layout>
    <x-slot name="header">
        Selesaikan Pembayaran Mahakarya
    </x-slot>

    <div class="py-4 md:py-8" x-data="{ uploading: false }">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-10 items-start">
                
                <!-- 🏺 Left: Official Receipt (Col 2/3) -->
                <div class="lg:col-span-2 space-y-6" data-aos="fade-right">
                    <div class="bg-white rounded-[2.5rem] shadow-[0_40px_80px_rgba(0,0,0,0.02)] border border-slate-100 overflow-hidden">
                        <!-- Invoice Header -->
                        <div class="p-8 md:p-12 bg-[#FDF8F0] border-b border-slate-50 flex flex-col md:flex-row justify-between items-center gap-6">
                            <div>
                                <h4 class="text-[9px] font-black text-gold uppercase tracking-[0.5em] mb-2">Invoice Number</h4>
                                <h2 class="font-serif text-2xl md:text-3xl font-black italic text-[#4D243D] tracking-tighter">{{ $transaction->invoice_number }}</h2>
                            </div>
                            <div class="text-center md:text-right">
                                <span class="px-5 py-2 rounded-full bg-amber-50 text-amber-600 text-[8px] font-black uppercase tracking-widest border border-amber-100">Menunggu Pembayaran</span>
                            </div>
                        </div>

                        <!-- Investment Summary -->
                        <div class="p-8 md:p-12">
                             <div class="flex flex-col md:flex-row justify-between items-center gap-8 mb-12">
                                 <div>
                                     <span class="text-[8px] font-black uppercase tracking-[0.3em] text-slate-400 block mb-2">Heritage Collection</span>
                                     <h3 class="text-xl md:text-2xl font-black text-[#4D243D] uppercase tracking-tight">{{ $transaction->package->name }}</h3>
                                 </div>
                                 <div class="text-center md:text-right">
                                      <p class="text-[8px] font-black uppercase tracking-[0.3em] text-slate-400 mb-1">Total Investment</p>
                                      <h3 class="font-serif text-3xl font-black text-[#4D243D] tracking-tighter italic">IDR {{ number_format($transaction->total_amount, 0, ',', '.') }}</h3>
                                 </div>
                             </div>

                             <div class="space-y-6 pt-10 border-t border-slate-50">
                                  <h4 class="text-[9px] font-black text-[#4D243D] uppercase tracking-[0.3em] mb-4">Rincian Paket:</h4>
                                  <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-4">
                                      @foreach(collect($transaction->package->features)->take(6) as $feature)
                                          <li class="flex items-center gap-3 text-[11px] font-medium text-slate-500 italic">
                                              <div class="w-1 h-1 rounded-full bg-gold/40"></div>
                                              <span>{{ $feature }}</span>
                                          </li>
                                      @endforeach
                                  </ul>
                             </div>
                        </div>
                    </div>

                    <!-- 🏺 Instructional Footer -->
                    <div class="p-8 rounded-[2.5rem] bg-slate-50 border border-slate-100 flex flex-col md:flex-row items-center gap-8 opacity-70">
                         <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center text-[#4D243D] text-lg shadow-sm flex-shrink-0">
                             <i class="fas fa-microchip"></i>
                         </div>
                         <div>
                             <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Automated Verification Notice</p>
                             <p class="text-[10px] font-medium text-slate-600 leading-loose italic">Harap unggah bukti pembayaran yang sah sesuai nominal yang tertera. Tim kurasi Memora Studio akan memverifikasi kiriman Anda dalam waktu maksimal 1x24 jam untuk aktivasi mahakarya.</p>
                         </div>
                    </div>
                </div>

                <!-- 🚀 Right: Artisan Settlement Portal (Col 1/3) -->
                <div class="lg:col-span-1 space-y-6 sticky top-28" data-aos="fade-left">
                    <div class="bg-white rounded-[2.5rem] shadow-[0_40px_80px_rgba(0,0,0,0.02)] border border-slate-100 p-8 md:p-10">
                        
                        <!-- Destination Detail -->
                        <div class="mb-10 text-center">
                            <h4 class="text-[10px] font-black text-[#4D243D] uppercase tracking-[0.3em] mb-8">Tujuan Transfer:</h4>
                            
                            @if($method)
                                <div class="bg-[#FDF8F0] p-6 rounded-3xl border border-[#EDD4B2]/30 group">
                                    <div class="flex items-center justify-center gap-3 mb-6">
                                         <div class="w-8 h-8 rounded-xl bg-[#4D243D] text-[#EDD4B2] flex items-center justify-center text-[10px] shadow-lg group-hover:scale-110 transition">
                                             <i class="fas {{ $method->qr_image ? 'fa-qrcode' : 'fa-university' }}"></i>
                                         </div>
                                         <span class="text-[11px] font-black uppercase text-[#4D243D] tracking-widest">{{ $method->name }}</span>
                                    </div>
                                    <div class="space-y-4">
                                         <div class="bg-white p-4 rounded-2xl border border-slate-100">
                                              <p class="text-[7px] font-black text-slate-400 uppercase tracking-widest mb-1">Nomor Rekening</p>
                                              <div class="flex items-center justify-between">
                                                  <span class="text-base font-black text-[#4D243D] tracking-tighter">{{ $method->account_number }}</span>
                                                  <button type="button" @click="navigator.clipboard.writeText('{{ $method->account_number }}'); Toast.fire({ icon: 'success', title: 'Disalin' })" class="text-slate-300 hover:text-gold transition">
                                                      <i class="far fa-copy text-[10px]"></i>
                                                  </button>
                                              </div>
                                         </div>
                                         <div>
                                              <p class="text-[7px] font-black text-slate-400 uppercase tracking-widest mb-1">Atas Nama</p>
                                              <p class="text-[11px] font-black text-[#4D243D] uppercase tracking-tighter italic">{{ $method->account_name }}</p>
                                         </div>
                                         @if($method->qr_image)
                                            <div class="pt-2">
                                                <img src="{{ asset('storage/' . $method->qr_image) }}" class="w-32 h-32 mx-auto rounded-xl shadow-sm border border-slate-50">
                                            </div>
                                         @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Upload Portal -->
                        <div class="pt-8 border-t border-slate-50">
                            <h4 class="text-[10px] font-black text-[#4D243D] uppercase tracking-[0.3em] mb-6">Unggah Bukti:</h4>
                            
                            <form action="{{ route('transactions.upload', $transaction) }}" method="POST" enctype="multipart/form-data" @submit="uploading = true">
                                @csrf
                                <div class="mb-6">
                                    <label for="p_proof" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-100 rounded-3xl hover:border-[#4D243D]/20 hover:bg-slate-50 transition cursor-pointer group">
                                        <i class="fas fa-cloud-arrow-up text-xl text-slate-300 mb-2 group-hover:text-gold transition"></i>
                                        <span class="text-[8px] font-black uppercase tracking-widest text-slate-400">Pilih File Gambar</span>
                                        <input type="file" id="p_proof" name="payment_proof" class="hidden" required @change="const n = $el.files[0] ? $el.files[0].name : ''; document.getElementById('f-name').innerText = n ? 'OK: ' + n : '';">
                                        <p id="f-name" class="mt-2 text-[7px] font-black text-emerald-500 uppercase tracking-tight"></p>
                                    </label>
                                </div>

                                <button type="submit" :disabled="uploading" class="w-full py-5 rounded-2xl bg-[#4D243D] text-[#EDD4B2] font-black text-[11px] uppercase tracking-[0.4em] shadow-xl hover:bg-slate-900 transition-all duration-500 active:scale-95 disabled:opacity-50">
                                    <span x-show="!uploading" class="flex items-center justify-center gap-4">
                                         <span>Kirim Bukti</span>
                                         <i class="fas fa-paper-plane text-[9px]"></i>
                                    </span>
                                    <span x-show="uploading" x-cloak class="flex items-center justify-center gap-4">
                                        <i class="fas fa-circle-notch animate-spin"></i>
                                        <span>Mengirimkan...</span>
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
