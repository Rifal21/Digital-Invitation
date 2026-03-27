<x-app-layout>
    <x-slot name="header">
        Sunting Provider Pembayaran
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2.5rem] shadow-[0_30px_60px_rgba(0,0,0,0.02)] border border-slate-50 overflow-hidden" data-aos="fade-up">
                <div class="p-12 md:p-16">
                    
                    <div class="mb-10 pb-6 border-b border-slate-50">
                        <span class="text-[9px] font-black text-rose-500 uppercase tracking-[0.6em] mb-2 block">Provider Management</span>
                        <h4 class="text-3xl font-serif font-black text-[#4D243D]">Ubah Data</h4>
                    </div>

                    <form method="POST" action="{{ route('admin.payment-methods.update', $paymentMethod) }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-3">
                            <label class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Provider Name</label>
                            <input type="text" name="name" value="{{ $paymentMethod->name }}" class="w-full px-6 py-4 rounded-xl border border-slate-100 bg-slate-50 text-[11px] font-bold text-[#4D243D] focus:ring-2 focus:ring-[#EDD4B2] focus:border-[#EDD4B2]" required>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Account Number (Opsional)</label>
                            <input type="text" name="account_number" value="{{ $paymentMethod->account_number }}" class="w-full px-6 py-4 rounded-xl border border-slate-100 bg-slate-50 text-[11px] font-bold text-[#4D243D] focus:ring-2 focus:ring-[#EDD4B2] focus:border-[#EDD4B2]">
                        </div>

                        <div class="space-y-3">
                            <label class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Account Holder Name (Opsional)</label>
                            <input type="text" name="account_name" value="{{ $paymentMethod->account_name }}" class="w-full px-6 py-4 rounded-xl border border-slate-100 bg-slate-50 text-[11px] font-bold text-[#4D243D] focus:ring-2 focus:ring-[#EDD4B2] focus:border-[#EDD4B2]">
                        </div>

                        <div class="grid grid-cols-2 gap-8 items-center pt-6">
                            <div class="space-y-3">
                                <label class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Update QR Code</label>
                                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-100 rounded-2xl hover:bg-slate-50 transition cursor-pointer p-4 text-center">
                                    <i class="fas fa-camera text-2xl text-slate-200 mb-2"></i>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Pilih Gambar</p>
                                    <input type="file" name="qr_image" class="hidden" accept="image/*">
                                </label>
                            </div>

                            @if($paymentMethod->qr_image)
                                <div class="space-y-3">
                                     <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest mb-1 italic">Current QRIS:</p>
                                     <div class="w-32 h-32 bg-slate-50 rounded-2xl border border-slate-100 p-2 overflow-hidden shadow-sm">
                                          <img src="{{ asset('storage/' . $paymentMethod->qr_image) }}" class="w-full h-full object-contain rounded-xl">
                                     </div>
                                </div>
                            @endif
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full py-6 rounded-2xl bg-[#4D243D] text-[#EDD4B2] font-black text-xs uppercase tracking-[0.4em] shadow-[0_15px_30px_rgba(77,36,61,0.2)] hover:bg-slate-900 transition-all duration-500 active:scale-95">
                                Perbarui & Simpan
                            </button>
                            <a href="{{ route('admin.payment-methods.index') }}" class="block text-center mt-6 text-[9px] font-black uppercase tracking-widest text-slate-300 hover:text-slate-500 transition">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
