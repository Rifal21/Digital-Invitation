<x-app-layout>
    <div class="space-y-10" data-aos="fade-up">
        <!-- Artisan Header Section -->
        <header class="relative overflow-hidden p-10 md:p-16 rounded-[3rem] bg-[#0F172A] text-[#C5A267] shadow-2xl">
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-white/5 rounded-full blur-[80px]"></div>
            <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-[#C5A267]/5 rounded-full blur-[60px]"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-10">
                <div class="max-w-2xl text-center md:text-left">
                    <span class="inline-flex items-center gap-4 py-2 px-6 mb-6 rounded-full border border-white/10 bg-white/5 text-[10px] font-black uppercase tracking-[0.6em] text-white/40">
                        Memora By FKStudio
                    </span>
                    <h1 class="font-serif text-5xl md:text-7xl font-black mb-6 leading-tight tracking-tighter">
                        Koleksi <br>
                        <span class="italic text-white">Mahakarya</span>
                    </h1>
                    <p class="text-[11px] md:text-xs font-bold uppercase tracking-[0.4em] text-white/40 italic leading-loose max-w-xl">
                        Daftar lengkap undangan digital eksklusif yang telah Anda rancang dalam ekosistem Memora By FKStudio.
                    </p>
                </div>
                
                <a href="{{ route('invitations.create') }}" class="group flex items-center justify-between gap-10 bg-[#C5A267] text-[#0F172A] px-12 py-7 rounded-[2.5rem] shadow-2xl hover:scale-105 active:scale-95 transition-all w-full md:w-auto">
                    <span class="text-[11px] font-black uppercase tracking-[0.4em]">Buat Undangan Baru</span>
                    <i class="fas fa-plus text-xs group-hover:rotate-180 transition-transform duration-700"></i>
                </a>
            </div>
        </header>

        <!-- Main Listing Exhibition -->
        <main class="space-y-12">
            @if(session('success'))
                <div class="p-6 bg-[#C5A267]/10 border border-[#C5A267]/20 rounded-[2rem] flex items-center gap-4 text-[#0F172A]">
                    <div class="w-10 h-10 bg-[#C5A267]/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-xs"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-widest">{{ session('success') }}</span>
                </div>
            @endif

            @if($invitations->isEmpty())
                <div class="bg-white p-32 rounded-[4rem] text-center border border-dashed border-slate-200 shadow-sm" data-aos="fade-up">
                    <div class="w-24 h-24 bg-[#0F172A]/5 rounded-full flex items-center justify-center text-[#0F172A] mx-auto mb-10 border border-[#0F172A]/5">
                        <i class="fas fa-feather-pointed text-4xl opacity-20"></i>
                    </div>
                    <h3 class="font-serif text-3xl font-black text-[#0F172A] mb-4 italic leading-tight">Mulai Kisah Kreatif Anda</h3>
                    <p class="text-slate-400 text-sm mb-12 max-w-sm mx-auto">Anda belum memiliki undangan digital yang aktif. Klik tombol di bawah untuk mulai merancang mahakarya pertama Anda.</p>
                    <a href="{{ route('invitations.create') }}" class="inline-flex items-center gap-6 bg-[#0F172A] text-[#C5A267] px-12 py-6 rounded-full shadow-2xl hover:scale-105 transition-all text-[10px] font-black uppercase tracking-[0.5em]">
                        Rancang Sekarang
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                    @foreach($invitations as $invitation)
                        <div class="group bg-white p-10 rounded-[3.5rem] border border-slate-100 shadow-[0_20px_60px_rgba(77,36,61,0.03)] hover:shadow-[0_40px_100px_rgba(77,36,61,0.12)] hover:border-[#C5A267]/40 transition duration-1000 relative overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                             <div class="absolute top-0 right-0 w-40 h-40 bg-slate-50 rounded-full -mr-20 -mt-20 opacity-50 group-hover:bg-[#C5A267]/10 group-hover:scale-125 transition duration-1000"></div>
                             
                             <div class="relative z-10 flex flex-col h-full">
                                 <!-- Category Tag -->
                                 <div class="flex justify-between items-center mb-10">
                                     <div class="flex items-center gap-3">
                                         <div class="w-3 h-3 rounded-full" style="background-color: {{ $invitation->theme_color ?? '#C5A267' }}"></div>
                                         <span class="text-[9px] font-black uppercase tracking-[0.3em] text-[#0F172A]/30">{{ $invitation->theme ?? 'Modern' }} Signature</span>
                                     </div>
                                     <div class="px-4 py-1.5 rounded-full border border-slate-100 bg-slate-50 text-slate-400 text-[8px] font-black uppercase tracking-widest italic group-hover:bg-[#C5A267]/20 group-hover:text-[#0F172A] transition">
                                         Standard
                                     </div>
                                 </div>

                                 <!-- Content -->
                                 <div class="flex-1 mb-12">
                                     <h4 class="font-bold text-3xl text-[#0F172A] mb-2 tracking-tighter leading-tight group-hover:text-[#C5A267] transition duration-700">{{ $invitation->title }}</h4>
                                     <p class="text-[11px] font-bold uppercase tracking-[0.4em] text-slate-300 italic mb-10">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</p>
                                     
                                     <div class="space-y-4">
                                         <div class="flex items-center gap-4 text-slate-400">
                                             <i class="far fa-calendar-check text-sm opacity-30"></i>
                                             <span class="text-[10px] font-bold uppercase tracking-widest">{{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d F Y') }}</span>
                                         </div>
                                         <div class="flex items-center gap-4 text-slate-400">
                                             <i class="fas fa-link text-sm opacity-30"></i>
                                             <span class="text-[10px] font-bold lowercase tracking-wider opacity-60">/v/{{ $invitation->slug }}</span>
                                         </div>
                                     </div>
                                 </div>

                                 <!-- Action Interface -->
                                 <div class="flex items-center gap-3 border-t border-slate-50 pt-8 mt-auto">
                                     <a href="{{ route('invitations.edit', $invitation) }}" class="flex-1 text-center py-5 bg-[#0F172A] text-[#C5A267] rounded-[1.8rem] text-[10px] font-black uppercase tracking-widest shadow-2xl hover:scale-105 active:scale-95 transition-all duration-500">
                                         Edit Creation
                                     </a>
                                     <div class="flex gap-2 shrink-0">
                                         <a href="{{ route('invitations.show', $invitation->slug) }}" target="_blank" class="w-14 h-14 flex items-center justify-center rounded-[1.5rem] bg-slate-50 text-slate-400 hover:bg-[#C5A267] hover:text-[#0F172A] transition duration-700 shadow-inner">
                                             <i class="fas fa-external-link-alt text-[11px]"></i>
                                         </a>
                                         <form action="{{ route('invitations.destroy', $invitation) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" @click="confirmAction(event, 'Apakah Anda yakin ingin menghapus mahakarya ini secara permanen?')" class="w-14 h-14 flex items-center justify-center rounded-[1.5rem] bg-red-50 text-red-300 hover:bg-red-500 hover:text-white transition duration-700">
                                                <i class="fas fa-trash-alt text-[11px]"></i>
                                            </button>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </main>
    </div>
</x-app-layout>
