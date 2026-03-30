<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-16 text-center">
                <h1 class="text-xs font-black text-[#C5A267] uppercase tracking-[0.6em] mb-4">Mulai Langkah Pertama</h1>
                <h2 class="text-4xl md:text-5xl font-serif font-black text-[#0F172A] mb-6 italic">Pilih Tema & Biarkan Keajaiban Dimulai</h2>
                <p class="text-slate-500 text-sm max-w-2xl mx-auto leading-relaxed">Pilih desain dasar yang Anda sukai. Anda akan diarahkan langsung ke **Live Editor** di mana Anda bisa mengubah semua detail, warna, teks, dan foto secara real-time.</p>
            </div>

            <!-- Theme Selection Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($themes as $theme)
                    <div class="group relative">
                        <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-700 border border-slate-100 group-hover:-translate-y-4">
                            <!-- Preview Image -->
                            <div class="aspect-[9/16] bg-slate-100 relative overflow-hidden">
                                <img src="{{ asset('themes/' . $theme->slug . '.webp') }}" 
                                     onerror="this.src='https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=800&q=80'"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                                
                                <!-- Overlay Selection -->
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A]/90 via-[#0F172A]/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col items-center justify-center p-8 text-center">
                                    <h4 class="text-white text-2xl font-serif italic font-black mb-4">{{ $theme->name }}</h4>
                                    <form action="{{ route('invitations.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="theme" value="{{ $theme->slug }}">
                                        <button type="submit" class="px-8 py-3 bg-[#C5A267] text-white rounded-full text-[10px] font-black uppercase tracking-widest shadow-xl hover:bg-white hover:text-[#C5A267] transition duration-300">
                                            Gunakan Tema Ini
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Footer Info -->
                            <div class="p-8 flex items-center justify-between">
                                <div>
                                    <h3 class="font-serif text-2xl font-black text-[#0F172A] italic">{{ $theme->name }}</h3>
                                    <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">{{ $theme->tag }}</span>
                                </div>
                                <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-[#C5A267]">
                                    <i class="fas fa-magic"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-24 text-center pb-20 border-t border-slate-200">
                <div class="inline-flex flex-col items-center mt-[-1rem] bg-slate-50 px-8">
                     <i class="fas fa-gem text-rose-200 text-3xl mb-6"></i>
                     <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Memora Premium Experience</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
