<x-app-layout>
    <div class="h-screen flex flex-col overflow-hidden bg-[#0F172A]" 
         x-data="{ 
            activeTab: 'edit', 
            formSection: 'general',
            isDirty: false
         }"
         @change="isDirty = true">
        
        <!-- Editor Header (Refined) -->
        <header class="h-16 md:h-20 bg-[#0F172A] border-b border-white/10 flex items-center justify-between px-4 md:px-10 shrink-0 z-50">
            <div class="flex items-center gap-4 md:gap-6">
                <a href="{{ route('invitations.index') }}" class="w-9 h-9 md:w-11 md:h-11 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-white hover:text-[#0F172A] transition duration-500">
                    <i class="fas fa-arrow-left text-xs"></i>
                </a>
                <div class="hidden sm:block">
                    <h2 class="font-serif text-xl font-black text-[#C5A267] tracking-tight uppercase leading-none">Editor Mahakarya</h2>
                    <p class="text-[8px] font-black tracking-[0.4em] uppercase text-white/30 mt-1">Refining Your Digital Legacy</p>
                </div>
                <div class="sm:hidden">
                    <h2 class="font-serif text-lg font-black text-[#C5A267] leading-none uppercase tracking-tighter">Memora Editor</h2>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('invitations.show', $invitation->slug) }}" target="_blank" class="hidden lg:flex items-center gap-3 text-white/40 hover:text-white text-[9px] font-black uppercase tracking-widest mr-4 transition">
                    <i class="fas fa-external-link-alt"></i>
                    Lihat Live
                </a>
                <!-- Save Button (Desktop Only in Header) -->
                <button form="edit-form" type="submit" class="hidden md:block bg-[#C5A267] text-[#0F172A] px-8 py-3 rounded-xl shadow-2xl hover:scale-105 active:scale-95 transition-all text-[9px] font-black uppercase tracking-[0.3em]">
                    Simpan Perubahan
                </button>
                <!-- Status Dot -->
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 border border-white/5 md:hidden">
                    <div class="w-1.5 h-1.5 rounded-full" :class="isDirty ? 'bg-amber-400 animate-pulse' : 'bg-emerald-400'"></div>
                    <span class="text-[7px] font-black uppercase tracking-widest text-white/40" x-text="isDirty ? 'Unsaved' : 'Synced'"></span>
                </div>
            </div>
        </header>

        <div class="flex-1 flex overflow-hidden relative">
            
            <!-- Left Panel: Form Settings -->
            <aside class="w-full md:w-[400px] lg:w-[480px] border-r border-white/5 flex flex-col bg-[#0F172A]" 
                   x-show="activeTab === 'edit'"
                   x-transition:enter="transition ease-out duration-300 transform"
                   x-transition:enter-start="-translate-x-full"
                   x-transition:enter-end="translate-x-0">
                
                <!-- Section Navigation (Mobile Quick Access) -->
                <div class="shrink-0 bg-white/[0.02] border-b border-white/5 flex overflow-x-auto no-scrollbar px-4 py-2 gap-2">
                    <button @click="formSection = 'general'" :class="formSection === 'general' ? 'bg-[#C5A267] text-[#0F172A]' : 'bg-white/5 text-white/40 hover:text-white'" class="px-5 py-3 rounded-xl text-[8px] font-black uppercase tracking-widest whitespace-nowrap transition-all duration-300 outline-none">
                        <i class="fas fa-id-card mr-2"></i> Dasar
                    </button>
                    <button @click="formSection = 'couple'" :class="formSection === 'couple' ? 'bg-[#C5A267] text-[#0F172A]' : 'bg-white/5 text-white/40 hover:text-white'" class="px-5 py-3 rounded-xl text-[8px] font-black uppercase tracking-widest whitespace-nowrap transition-all duration-300 outline-none">
                        <i class="fas fa-heart mr-2"></i> Pasangan
                    </button>
                    <button @click="formSection = 'event'" :class="formSection === 'event' ? 'bg-[#C5A267] text-[#0F172A]' : 'bg-white/5 text-white/40 hover:text-white'" class="px-5 py-3 rounded-xl text-[8px] font-black uppercase tracking-widest whitespace-nowrap transition-all duration-300 outline-none">
                        <i class="fas fa-calendar mr-2"></i> Acara
                    </button>
                    <button @click="formSection = 'style'" :class="formSection === 'style' ? 'bg-[#C5A267] text-[#0F172A]' : 'bg-white/5 text-white/40 hover:text-white'" class="px-5 py-3 rounded-xl text-[8px] font-black uppercase tracking-widest whitespace-nowrap transition-all duration-300 outline-none">
                        <i class="fas fa-palette mr-2"></i> Gaya
                    </button>
                    <button @click="formSection = 'media'" :class="formSection === 'media' ? 'bg-[#C5A267] text-[#0F172A]' : 'bg-white/5 text-white/40 hover:text-white'" class="px-5 py-3 rounded-xl text-[8px] font-black uppercase tracking-widest whitespace-nowrap transition-all duration-300 outline-none">
                        <i class="fas fa-images mr-2"></i> Media
                    </button>
                </div>

                <!-- Form Content Area -->
                <div class="flex-1 overflow-y-auto custom-scrollbar">
                    <form id="edit-form" action="{{ route('invitations.update', $invitation->id) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-10">
                        @csrf
                        @method('PUT')

                        <!-- Section: Identitas Utama -->
                        <div class="space-y-6" x-show="formSection === 'general'" x-transition:enter="transition ease-out duration-300 opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                            <h3 class="text-[9px] font-black uppercase tracking-[0.4em] text-[#C5A267]/60 mb-8 border-l-2 border-[#C5A267] pl-4">Identitas Dasar</h3>
                            <div class="space-y-4">
                                <div class="group">
                                    <label class="block text-[8px] font-black uppercase tracking-widest text-white/20 mb-2 group-focus-within:text-[#C5A267] transition">Judul Undangan</label>
                                    <input type="text" name="title" value="{{ old('title', $invitation->title) }}" 
                                        class="w-full bg-white/5 border-white/5 rounded-2xl p-4 text-white text-sm focus:border-[#C5A267]/50 focus:ring-0 transition duration-500 placeholder:italic placeholder:text-white/5">
                                    @error('title') <span class="text-red-400 text-[9px] font-bold mt-2 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="group">
                                    <label class="block text-[8px] font-black uppercase tracking-widest text-white/20 mb-2 group-focus-within:text-[#C5A267] transition">URL Kustom (Slug)</label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white/10 text-[9px] font-bold">memora.id/</span>
                                        <input type="text" name="slug" value="{{ old('slug', $invitation->slug) }}" 
                                            class="w-full bg-white/5 border-white/5 rounded-2xl p-4 pl-24 text-white text-sm focus:border-[#C5A267]/50 focus:ring-0 transition">
                                    </div>
                                    @error('slug') <span class="text-red-400 text-[9px] font-bold mt-2 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section: Sang Mempelai -->
                        <div class="space-y-6" x-show="formSection === 'couple'" x-transition:enter="transition ease-out duration-300 opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-cloak>
                            <h3 class="text-[9px] font-black uppercase tracking-[0.4em] text-[#C5A267]/60 mb-8 border-l-2 border-[#C5A267] pl-4">Para Mempelai</h3>
                            <div class="grid grid-cols-1 gap-4">
                                <div class="group">
                                    <label class="block text-[8px] font-black uppercase tracking-widest text-white/20 mb-2 group-focus-within:text-[#C5A267]">Nama Mempelai Pria</label>
                                    <input type="text" name="groom_name" value="{{ old('groom_name', $invitation->groom_name) }}" 
                                        class="w-full bg-white/5 border-white/5 rounded-2xl p-4 text-white text-sm focus:border-[#C5A267]/50 focus:ring-0 transition uppercase font-black tracking-widest">
                                </div>
                                <div class="group">
                                    <label class="block text-[8px] font-black uppercase tracking-widest text-white/20 mb-2 group-focus-within:text-[#C5A267]">Nama Mempelai Wanita</label>
                                    <input type="text" name="bride_name" value="{{ old('bride_name', $invitation->bride_name) }}" 
                                        class="w-full bg-white/5 border-white/5 rounded-2xl p-4 text-white text-sm focus:border-[#C5A267]/50 focus:ring-0 transition uppercase font-black tracking-widest">
                                </div>
                            </div>
                        </div>

                        <!-- Section: Detail Acara -->
                        <div class="space-y-6" x-show="formSection === 'event'" x-transition:enter="transition ease-out duration-300 opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-cloak>
                            <h3 class="text-[9px] font-black uppercase tracking-[0.4em] text-[#C5A267]/60 mb-8 border-l-2 border-[#C5A267] pl-4">Waktu & Tempat</h3>
                            <div class="space-y-4">
                                <div class="group">
                                    <label class="block text-[8px] font-black uppercase tracking-widest text-white/20 mb-2 group-focus-within:text-[#C5A267]">Tanggal Resepsi</label>
                                    <input type="date" name="event_date" value="{{ old('event_date', $invitation->event_date) }}" 
                                        class="w-full bg-white/5 border-white/5 rounded-2xl p-4 text-white text-sm focus:border-[#C5A267]/50 focus:ring-0 transition">
                                </div>
                                <div class="group">
                                    <label class="block text-[8px] font-black uppercase tracking-widest text-white/20 mb-2 group-focus-within:text-[#C5A267]">Lokasi Perayaan</label>
                                    <textarea name="event_location" rows="4" 
                                        class="w-full bg-white/5 border-white/5 rounded-2xl p-4 text-white text-sm focus:border-[#C5A267]/50 focus:ring-0 transition">{{ old('event_location', $invitation->event_location) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Gaya -->
                        <div class="space-y-6" x-show="formSection === 'style'" x-transition:enter="transition ease-out duration-300 opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-cloak>
                            <h3 class="text-[9px] font-black uppercase tracking-[0.4em] text-[#C5A267]/60 mb-8 border-l-2 border-[#C5A267] pl-4">Tema & Estetika</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="group">
                                    <label class="block text-[8px] font-black uppercase tracking-widest text-white/20 mb-2 group-focus-within:text-[#C5A267]">Warna Aksen</label>
                                    <div class="flex items-center gap-4 bg-white/5 border border-white/5 rounded-2xl p-3">
                                        <input type="color" name="theme_color" value="{{ old('theme_color', $invitation->theme_color) }}" 
                                            class="w-12 h-12 bg-transparent border-none rounded-xl cursor-pointer">
                                        <span class="text-[10px] font-mono text-white/40 uppercase tracking-widest">{{ old('theme_color', $invitation->theme_color) }}</span>
                                    </div>
                                </div>
                                <div class="group">
                                    <label class="block text-[8px] font-black uppercase tracking-widest text-white/20 mb-2 group-focus-within:text-[#C5A267]">Template Desain</label>
                                    <select name="theme" class="w-full bg-white/5 border-white/5 rounded-2xl p-4 text-white text-[10px] font-black uppercase tracking-widest focus:border-[#C5A267]/50 focus:ring-0 transition h-16 cursor-pointer">
                                        @foreach($themes as $theme)
                                            <option value="{{ $theme->slug }}" {{ old('theme', $invitation->theme) == $theme->slug ? 'selected' : '' }} class="bg-[#0F172A] text-white">
                                                {{ $theme->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Media -->
                        <div class="space-y-6" x-show="formSection === 'media'" x-transition:enter="transition ease-out duration-300 opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-cloak>
                            <h3 class="text-[9px] font-black uppercase tracking-[0.4em] text-[#C5A267]/60 mb-8 border-l-2 border-[#C5A267] pl-4">Media Mahakarya</h3>
                            <div class="grid grid-cols-1 gap-4">
                                <div class="relative group/upload bg-white/5 border border-white/5 rounded-[2rem] p-6 text-center hover:border-[#C5A267]/30 transition duration-700">
                                    <label class="cursor-pointer block">
                                        <i class="fas fa-feather text-[#C5A267] text-2xl mb-4 block"></i>
                                        <span class="block text-[9px] font-black uppercase tracking-widest text-white">Hero Image</span>
                                        <span class="block text-[7px] font-bold text-white/20 uppercase mt-1">Background Utama</span>
                                        <input type="file" name="hero_image" class="hidden">
                                    </label>
                                </div>
                                <div class="relative group/upload bg-white/5 border border-white/5 rounded-[2rem] p-6 text-center hover:border-[#C5A267]/30 transition duration-700">
                                    <label class="cursor-pointer block">
                                        <i class="fas fa-wand-sparkles text-[#C5A267] text-2xl mb-4 block"></i>
                                        <span class="block text-[9px] font-black uppercase tracking-widest text-white">Background Body</span>
                                        <span class="block text-[7px] font-bold text-white/20 uppercase mt-1">Tekstur Atmosferik</span>
                                        <input type="file" name="background_image" class="hidden">
                                    </label>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </aside>

            <!-- Right Panel: Live Preview -->
            <main class="flex-1 bg-[#090E1A] overflow-hidden relative group" 
                  x-show="activeTab === 'preview'"
                  x-transition:enter="transition ease-out duration-300 transform"
                  x-transition:enter-start="translate-x-full"
                  x-transition:enter-end="translate-x-0"
                  :class="activeTab === 'preview' ? 'block' : 'hidden md:block'">
                
                <div class="h-full w-full flex flex-col items-center justify-center relative md:p-8 lg:p-12 transition-all duration-700">
                    
                    <!-- Decorative BG for Desktop -->
                    <div class="hidden md:block absolute inset-0 pointer-events-none opacity-20">
                        <div class="absolute top-0 right-0 w-96 h-96 bg-[#C5A267]/10 rounded-full blur-[100px]"></div>
                        <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/5 rounded-full blur-[100px]"></div>
                    </div>

                    <!-- Device Wrapper -->
                    <div class="relative w-full h-full md:max-w-[375px] md:aspect-[9/19] bg-white md:rounded-[3rem] md:shadow-[0_100px_100px_-50px_rgba(0,0,0,0.8)] md:border-[12px] md:border-slate-950 overflow-hidden group/device flex flex-col">
                        <div class="hidden md:block absolute top-0 left-1/2 -translate-x-1/2 w-32 h-6 bg-slate-950 rounded-b-2xl z-50"></div>
                        
                        <iframe id="preview-frame" src="{{ route('invitations.show', $invitation->slug) }}" 
                             class="flex-1 w-full border-none pointer-events-auto"></iframe>
                        
                        <!-- Floating Refresh on Preview (Mobile/Desktop) -->
                        <button onclick="document.getElementById('preview-frame').contentWindow.location.reload();" 
                                class="absolute bottom-10 right-10 md:left-1/2 md:right-auto md:-translate-x-1/2 bg-white/10 backdrop-blur-xl border border-white/20 text-white w-14 h-14 rounded-full flex items-center justify-center hover:bg-[#C5A267] hover:text-[#0F172A] transition-all duration-500 shadow-2xl z-50 group-active:scale-95">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>

                    <p class="hidden md:block mt-8 text-[9px] font-black tracking-[0.6em] uppercase text-white/10 italic animate-pulse">Orchestrating Beauty</p>
                </div>
            </main>

            <!-- Bottom Action Bar (Mobile Premium) -->
            <div class="md:hidden fixed bottom-0 left-0 right-0 bg-[#0F172A]/90 backdrop-blur-2xl border-t border-white/10 p-5 flex items-center gap-4 z-[60]">
                <button @click="activeTab = (activeTab === 'edit' ? 'preview' : 'edit')" 
                        class="w-16 h-16 rounded-2xl bg-white/5 border border-white/10 flex flex-col items-center justify-center text-white transition-all active:scale-90 overflow-hidden group relative">
                    <div class="absolute inset-0 bg-[#C5A267] opacity-0 group-active:opacity-10 transition"></div>
                    <i class="fas text-lg text-[#C5A267]" :class="activeTab === 'edit' ? 'fa-eye' : 'fa-pen-to-square'"></i>
                    <span class="text-[7px] font-black uppercase tracking-widest mt-1" x-text="activeTab === 'edit' ? 'Intip' : 'Ubah'"></span>
                </button>
                
                <button form="edit-form" type="submit" 
                        class="flex-1 h-16 bg-[#C5A267] text-[#0F172A] rounded-2xl shadow-[0_15px_40px_rgba(197,162,103,0.3)] flex items-center justify-center gap-4 active:scale-[0.98] transition-all">
                    <span class="text-[11px] font-black uppercase tracking-[0.3em]">Terbitkan Perubahan</span>
                    <i class="fas fa-paper-plane text-[10px]"></i>
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    <script>
        // Smooth transition helper
        window.addEventListener('scroll', () => {}, {passive: true});
    </script>
    @endpush
</x-app-layout>
