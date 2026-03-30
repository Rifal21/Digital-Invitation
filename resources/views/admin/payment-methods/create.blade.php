<x-app-layout>
    <x-slot name="header">
        Tambah Provider Pembayaran
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2.5rem] shadow-[0_30px_60px_rgba(0,0,0,0.02)] border border-slate-50 overflow-hidden" data-aos="fade-up">
                <div class="p-12 md:p-16">
                    
                    <div class="mb-10 pb-6 border-b border-slate-50">
                        <span class="text-[9px] font-black text-indigo-500 uppercase tracking-[0.6em] mb-2 block">New Channel</span>
                        <h4 class="text-3xl font-serif font-black text-[#0F172A]">Provider Baru</h4>
                    </div>

                    <form method="POST" action="{{ route('admin.payment-methods.store') }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        
                        <div class="space-y-3">
                            <label class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Provider Name (e.g. QRIS, BCA, DANA)</label>
                            <input type="text" name="name" placeholder="Nama provider..." class="w-full px-6 py-4 rounded-xl border border-slate-100 bg-slate-50 text-[11px] font-bold text-[#0F172A] focus:ring-2 focus:ring-[#C5A267] focus:border-[#C5A267] transition duration-300" required>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Account Number (Opsional)</label>
                            <input type="text" name="account_number" placeholder="Nomor rekening..." class="w-full px-6 py-4 rounded-xl border border-slate-100 bg-slate-50 text-[11px] font-bold text-[#0F172A] focus:ring-2 focus:ring-[#C5A267] focus:border-[#C5A267] transition duration-300">
                        </div>

                        <div class="space-y-3">
                            <label class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Account Holder Name (Opsional)</label>
                            <input type="text" name="account_name" placeholder="Nama pemilik..." class="w-full px-6 py-4 rounded-xl border border-slate-100 bg-slate-50 text-[11px] font-bold text-[#0F172A] focus:ring-2 focus:ring-[#C5A267] focus:border-[#C5A267] transition duration-300">
                        </div>

                        <div class="space-y-3">
                            <label class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">QR Code / QRIS Image</label>
                            <div class="relative group">
                                <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-slate-100 rounded-2xl hover:bg-slate-50 transition cursor-pointer p-6 text-center">
                                    <i class="fas fa-qrcode text-3xl text-slate-200 mb-3 group-hover:text-[#0F172A]/30 transition"></i>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Unggah Gambar QR</p>
                                    <input type="file" name="qr_image" class="hidden" accept="image/*">
                                </label>
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full py-6 rounded-2xl bg-[#0F172A] text-[#C5A267] font-black text-xs uppercase tracking-[0.4em] shadow-[0_15px_30px_rgba(77,36,61,0.2)] hover:bg-slate-900 transition-all duration-500 active:scale-95">
                                Simpan Provider
                            </button>
                            <a href="{{ route('admin.payment-methods.index') }}" class="block text-center mt-6 text-[9px] font-black uppercase tracking-widest text-slate-300 hover:text-slate-500 transition">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
