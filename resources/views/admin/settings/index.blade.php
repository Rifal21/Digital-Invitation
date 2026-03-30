<x-app-layout>
    <x-slot name="header">
        Konfigurasi Platform
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2.5rem] shadow-[0_30px_60px_rgba(0,0,0,0.02)] border border-slate-50 overflow-hidden" data-aos="fade-up">
                <div class="p-12 md:p-16">
                    
                    <div class="mb-10 pb-6 border-b border-slate-50">
                        <span class="text-[9px] font-black text-indigo-500 uppercase tracking-[0.6em] mb-2 block">System Engine</span>
                        <h4 class="text-3xl font-serif font-black text-[#0F172A]">Pengaturan Global</h4>
                    </div>

                    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-10">
                        @csrf
                        @method('PATCH')
                        
                        <!-- Admin Fee Config -->
                        <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 group hover:bg-white hover:shadow-xl transition duration-500">
                             <div class="flex items-center gap-4 mb-6">
                                 <div class="w-10 h-10 bg-[#0F172A] rounded-xl flex items-center justify-center text-[#C5A267] shadow-lg group-hover:rotate-12 transition">
                                     <i class="fas fa-coins"></i>
                                 </div>
                                 <h4 class="text-sm font-serif font-black text-[#0F172A] italic uppercase">Financial Settings</h4>
                             </div>

                             <div class="space-y-3">
                                 <label class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Biaya Layanan (Admin Fee)</label>
                                 <div class="relative">
                                      <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                                          <span class="text-[9px] font-black text-slate-400">Rp</span>
                                      </div>
                                      <input type="number" name="admin_fee" value="{{ $settings['admin_fee'] }}" class="w-full pl-12 pr-6 py-4 rounded-xl border border-slate-100 bg-white text-[11px] font-bold text-[#0F172A] focus:ring-2 focus:ring-[#C5A267] transition duration-300" required>
                                 </div>
                                 <p class="text-[8px] font-black text-slate-300 uppercase italic tracking-widest mt-2">Biaya ini akan ditambahkan pada setiap checkout paket.</p>
                             </div>
                        </div>

                        <!-- Submit Section -->
                        <div class="pt-6">
                            <button type="submit" class="w-full py-6 rounded-2xl bg-[#0F172A] text-[#C5A267] font-black text-xs uppercase tracking-[0.4em] shadow-[0_15px_30px_rgba(77,36,61,0.2)] hover:bg-slate-900 transition-all duration-500 active:scale-95">
                                Perbarui Pengaturan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
