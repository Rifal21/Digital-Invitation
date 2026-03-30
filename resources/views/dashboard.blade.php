<x-app-layout>
    <div class="space-y-10" data-aos="fade-up">
        <!-- Artisan Welcome Area -->
        <header class="relative overflow-hidden p-10 md:p-16 rounded-[3rem] bg-[#0F172A] text-[#C5A267] shadow-2xl">
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-white/5 rounded-full blur-[80px]"></div>
            <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-[#C5A267]/5 rounded-full blur-[60px]"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-10">
                <div class="max-w-2xl text-center md:text-left">
                    <span class="inline-flex items-center gap-4 py-2 px-6 mb-6 rounded-full border border-white/10 bg-white/5 text-[10px] font-black uppercase tracking-[0.6em] text-white/40">
                        <span class="h-1 w-1 rounded-full bg-[#C5A267] animate-ping"></span>
                        Creator Dashboard
                    </span>
                    <h1 class="font-serif text-5xl md:text-7xl font-black mb-6 leading-tight tracking-tighter">
                        Selamat Datang, <br>
                        <span class="italic text-white">{{ Auth::user()->name }}</span>
                    </h1>
                    <p class="text-[11px] md:text-xs font-bold uppercase tracking-[0.4em] text-white/40 italic leading-loose max-w-xl mx-auto md:mx-0">
                        Pusat Otoritas Desain Memora By FKStudio. <br> Kelola mahakarya digital Anda dengan presisi artistik mutlak.
                    </p>
                </div>
                
                <div class="flex flex-col gap-4 w-full md:w-auto">
                    <a href="{{ route('invitations.create') }}" class="group flex items-center justify-between gap-10 bg-[#C5A267] text-[#0F172A] px-10 py-6 rounded-[2rem] shadow-2xl hover:scale-105 active:scale-95 transition-all">
                        <span class="text-[11px] font-black uppercase tracking-[0.4em]">Buat Undangan Baru</span>
                        <i class="fas fa-plus text-xs group-hover:rotate-180 transition-transform duration-700"></i>
                    </a>
                    <a href="{{ route('themes.index') }}" class="group flex items-center justify-between gap-10 bg-white/5 border border-white/10 text-white px-10 py-6 rounded-[2rem] hover:bg-white hover:text-[#0F172A] transition-all">
                        <span class="text-[11px] font-black uppercase tracking-[0.4em]">Jelajahi Katalog Tema</span>
                        <i class="fas fa-arrow-right text-xs group-hover:translate-x-2 transition-transform duration-500"></i>
                    </a>
                </div>
            </div>
        </header>

        <!-- Stats Orchestration -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-xl group hover:border-[#C5A267]/40 transition duration-700">
                <div class="flex justify-between items-start mb-10">
                    <div class="w-14 h-14 bg-[#0F172A]/5 rounded-2xl flex items-center justify-center text-[#0F172A] group-hover:bg-[#0F172A] group-hover:text-[#C5A267] transition duration-700 shadow-inner">
                        <i class="fas fa-envelope-open-text text-xl"></i>
                    </div>
                    <span class="text-[9px] font-black tracking-widest text-[#C5A267] uppercase">Active</span>
                </div>
                <div>
                    <h3 class="text-4xl font-black text-[#0F172A] mb-2">{{ Auth::user()->invitations()->count() }}</h3>
                    <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-slate-400">Total Undangan Saya</p>
                </div>
            </div>

            <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-xl group hover:border-[#C5A267]/40 transition duration-700">
                <div class="flex justify-between items-start mb-10">
                    <div class="w-14 h-14 bg-[#0F172A]/5 rounded-2xl flex items-center justify-center text-[#0F172A] group-hover:bg-[#0F172A] group-hover:text-[#C5A267] transition duration-700 shadow-inner">
                        <i class="fas fa-comment-dots text-xl"></i>
                    </div>
                    <span class="text-[9px] font-black tracking-widest text-[#C5A267] uppercase">Real-Time</span>
                </div>
                <div>
                    @php
                        $msgCount = \App\Models\InvitationMessage::whereIn('invitation_id', Auth::user()->invitations()->pluck('id'))->count();
                    @endphp
                    <h3 class="text-4xl font-black text-[#0F172A] mb-2">{{ $msgCount }}</h3>
                    <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-slate-400">Pesan & Doa Restu</p>
                </div>
            </div>

            <div class="bg-[#FDFCFB] p-10 rounded-[2.5rem] border border-[#C5A267]/20 shadow-xl group hover:bg-[#0F172A] transition duration-1000">
                <div class="flex justify-between items-start mb-10">
                    <div class="w-14 h-14 bg-[#C5A267]/10 rounded-2xl flex items-center justify-center text-[#0F172A] group-hover:bg-[#C5A267] transition duration-700 shadow-inner">
                        <i class="fas fa-star text-xl opacity-60"></i>
                    </div>
                    <span class="text-[9px] font-black tracking-widest text-[#C5A267] uppercase italic">Artisan</span>
                </div>
                <div>
                    <h3 class="text-3xl font-serif font-black text-[#0F172A] mb-2 italic group-hover:text-[#C5A267]">Standard Edition</h3>
                    <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-slate-400 group-hover:text-white/30">Paket Layanan Eksklusif</p>
                </div>
            </div>
        </div>
        
        <!-- Quick Navigation Grid -->
        <section class="space-y-8" data-aos="fade-up">
            <div class="px-4">
                <h2 class="font-serif text-3xl font-black text-[#0F172A]">Akses Manajemen</h2>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-2">Masuk ke ruang kerja mahakarya Anda</p>
            </div>
            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('invitations.index') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg hover:border-[#C5A267]/40 hover:scale-105 transition-all duration-500">
                    <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-[#0F172A] mb-6 group-hover:bg-[#0F172A] group-hover:text-[#C5A267] transition-all duration-500">
                        <i class="fas fa-envelopes-bulk text-xl"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-[#0F172A]">Daftar Undangan</span>
                </a>

                <a href="{{ route('transactions.history') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg hover:border-[#C5A267]/40 hover:scale-105 transition-all duration-500">
                    <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-[#0F172A] mb-6 group-hover:bg-[#0F172A] group-hover:text-[#C5A267] transition-all duration-500">
                        <i class="fas fa-receipt text-xl"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-[#0F172A]">Riwayat Order</span>
                </a>

                <a href="{{ route('themes.index') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg hover:border-[#C5A267]/40 hover:scale-105 transition-all duration-500">
                    <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-[#0F172A] mb-6 group-hover:bg-[#0F172A] group-hover:text-[#C5A267] transition-all duration-500">
                        <i class="fas fa-palette text-xl"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-[#0F172A]">Katalog Tema</span>
                </a>

                <a href="{{ route('profile.edit') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-lg hover:border-[#C5A267]/40 hover:scale-105 transition-all duration-500">
                    <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-[#0F172A] mb-6 group-hover:bg-[#0F172A] group-hover:text-[#C5A267] transition-all duration-500">
                        <i class="fas fa-user-gear text-xl"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-[#0F172A]">Pengaturan</span>
                </a>
            </div>
        </section>

        <!-- Latest Creations Section -->
        <section class="space-y-8">
            <div class="flex justify-between items-end px-4">
                <div>
                    <h2 class="font-serif text-3xl font-black text-[#0F172A]">Mahakarya Terbaru</h2>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-2">Daftar undangan digital Anda yang aktif</p>
                </div>
                <a href="{{ route('invitations.index') }}" class="text-[10px] font-black uppercase tracking-widest text-[#C5A267] hover:text-[#0F172A] transition border-b border-[#C5A267]/20">Lihat Semua</a>
            </div>

            @php $latestInv = Auth::user()->invitations()->latest()->take(3)->get(); @endphp
            @if($latestInv->isEmpty())
                <div class="bg-white p-20 rounded-[3.5rem] text-center border border-dashed border-slate-200 shadow-sm" data-aos="fade-up">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mx-auto mb-8">
                        <i class="fas fa-feather-pointed text-3xl"></i>
                    </div>
                    <p class="text-slate-400 font-serif text-xl italic mb-10">Setiap janji diawali dengan langkah pertama.</p>
                    <a href="{{ route('invitations.create') }}" class="inline-flex items-center gap-6 bg-[#0F172A] text-[#C5A267] px-10 py-5 rounded-full shadow-xl hover:scale-105 transition-all text-[9px] font-black uppercase tracking-widest">
                        Mulai Buat Undangan
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($latestInv as $inv)
                        <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-xl group hover:border-[#C5A267]/40 transition duration-700 overflow-hidden relative" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                             <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-full -mr-16 -mt-16 opacity-50 group-hover:bg-[#C5A267]/10 transition duration-700"></div>
                             
                             <div class="relative z-10">
                                 <div class="flex items-center gap-3 mb-8">
                                     <div class="w-2 h-2 rounded-full" style="background-color: {{ $inv->theme_color ?? '#C5A267' }}"></div>
                                     <span class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-400">{{ $inv->theme }} Theme</span>
                                 </div>
                                 <h4 class="font-bold text-lg text-[#0F172A] mb-1 tracking-tight leading-tight group-hover:text-[#C5A267] transition duration-500">{{ $inv->title }}</h4>
                                 <p class="text-[11px] font-medium italic text-slate-400 mb-8">{{ $inv->groom_name }} & {{ $inv->bride_name }}</p>
                                 
                                 <div class="flex gap-2">
                                     <a href="{{ route('invitations.edit', $inv) }}" class="flex-1 text-center py-4 bg-[#0F172A] text-[#C5A267] rounded-2xl text-[9px] font-black uppercase tracking-widest shadow-xl hover:scale-105 active:scale-95 transition-all">
                                         Kustomisasi
                                     </a>
                                     <a href="{{ route('invitations.show', $inv->slug) }}" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-slate-50 text-slate-400 hover:bg-[#C5A267] hover:text-[#0F172A] transition duration-500">
                                         <i class="fas fa-external-link-alt text-[10px]"></i>
                                     </a>
                                 </div>
                             </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</x-app-layout>
