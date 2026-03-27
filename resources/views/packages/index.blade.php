<x-app-layout>
    <div class="py-12 md:py-24 bg-[#F8F9FA] min-h-screen">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            
            <!-- Luxury Header -->
            <div class="text-center mb-20" data-aos="fade-up">
                <span class="text-[#4D243D]/40 font-black uppercase tracking-[0.6em] text-[10px] mb-4 block">Pick Your Plan</span>
                <h2 class="text-5xl md:text-7xl font-serif font-black text-[#4D243D] mb-6 leading-tight">
                    Investasi <span class="italic text-slate-400">untuk</span> <br> Momen Berharga
                </h2>
                <p class="max-w-2xl mx-auto text-[#4D243D]/60 text-lg font-medium leading-relaxed italic">
                    Keindahan digital yang abadi. Pilih paket yang paling cocok dengan perayaan impian Anda.
                </p>
                <div class="w-24 h-1 bg-[#EDD4B2] mx-auto mt-10 rounded-full shadow-sm"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl mx-auto">
                @foreach($packages as $package)
                    <div class="group relative bg-white rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-slate-100 flex flex-col transition-all duration-700 hover:shadow-[0_40px_80px_rgba(77,36,61,0.08)] hover:-translate-y-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                        
                        <!-- Floating Badge for Popularity -->
                        @if($loop->last)
                            <div class="absolute -top-5 right-12 z-10">
                                <span class="bg-[#EDD4B2] text-[#4D243D] text-[10px] font-black uppercase tracking-[0.2em] px-6 py-2.5 rounded-full shadow-2xl border-4 border-white">Terpopuler</span>
                            </div>
                        @endif
                        
                        <!-- Price Header -->
                        <div class="p-12 md:p-16 text-center border-b border-slate-50 relative overflow-hidden">
                            <!-- Background Decor -->
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#EDD4B2]/10 rounded-full blur-3xl group-hover:bg-[#EDD4B2]/20 transition duration-700"></div>

                            <h3 class="text-3xl font-serif font-black text-[#4D243D] mb-8 group-hover:tracking-widest transition-all duration-700">{{ $package->name }}</h3>
                            
                            <div class="inline-flex items-center justify-center bg-[#F8F9FA] px-10 py-6 rounded-3xl border border-slate-50 shadow-inner group-hover:bg-white transition duration-700">
                                <span class="text-xl font-bold text-[#4D243D]/40 mr-2 italic">Rp</span>
                                <span class="text-5xl font-extrabold tracking-tighter text-[#4D243D]">{{ number_format($package->price, 0, ',', '.') }}</span>
                            </div>
                            <p class="mt-4 text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">Masa Aktif Selamanya</p>
                        </div>

                        <!-- Feature List -->
                        <div class="p-12 md:p-16 flex-grow">
                            <ul class="space-y-6">
                                @foreach($package->features as $feature)
                                    <li class="flex items-center group/item">
                                        <div class="w-8 h-8 rounded-2xl bg-[#EDD4B2]/20 flex items-center justify-center mr-5 group-hover/item:bg-[#4D243D] transition duration-500">
                                            <i class="fas fa-check text-[#4D243D] text-[10px] group-hover/item:text-[#EDD4B2]"></i>
                                        </div>
                                        <span class="text-[#4D243D]/70 font-bold italic tracking-wide group-hover/item:text-[#4D243D] transition duration-300">{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Action Area -->
                        <div class="p-12 md:p-16 pt-0">
                            <form action="{{ route('transactions.store', $package) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-6 rounded-2xl bg-[#4D243D] text-[#EDD4B2] font-black text-xs uppercase tracking-[0.4em] shadow-[0_15px_30px_rgba(77,36,61,0.2)] hover:bg-slate-900 hover:shadow-2xl hover:scale-[1.03] transition-all duration-500 active:scale-95 flex items-center justify-center gap-4">
                                    <span>Pilih Produk Ini</span>
                                    <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-2 transition-transform duration-500"></i>
                                </button>
                            </form>
                            <p class="mt-6 text-center text-[9px] font-black text-slate-300 uppercase tracking-[0.2em] italic">Full Access & Unlimited Revision</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Footer Demo Link -->
            <div class="mt-32 text-center" data-aos="fade-up">
                <div class="flex items-center justify-center gap-4 mb-8">
                    <div class="h-px w-12 bg-slate-200"></div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.5em]">Still Unsure?</span>
                    <div class="h-px w-12 bg-slate-200"></div>
                </div>
                <a href="{{ route('themes.index') }}" class="group inline-flex flex-col items-center">
                    <span class="text-2xl font-serif font-black text-[#4D243D] mb-2 group-hover:tracking-widest transition-all duration-700">Jelajahi Demo Terlebih Dahulu</span>
                    <div class="flex items-center text-[#4D243D]/40 font-bold italic text-sm group-hover:text-[#4D243D] transition duration-500">
                        See how it looks in real action
                        <i class="fas fa-chevron-right ml-3 group-hover:translate-x-3 transition-transform duration-500"></i>
                    </div>
                    <div class="w-0 group-hover:w-full h-px bg-[#4D243D]/20 mt-4 transition-all duration-700"></div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
