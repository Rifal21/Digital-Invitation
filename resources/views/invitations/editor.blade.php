<x-app-layout>
    <div class="h-screen flex flex-col overflow-hidden bg-slate-950" x-data="invitationEditor()">
        <!-- Header -->
        <header class="h-16 bg-slate-900 border-b border-white/5 flex items-center justify-between px-6 shrink-0 z-50">
            <div class="flex items-center gap-4">
                <a href="{{ route('invitations.index') }}" class="p-2 text-slate-400 hover:text-white transition">
                    <i class="fas fa-arrow-left text-lg"></i>
                </a>
                <div>
                    <h1 class="text-xs font-black text-rose-500 uppercase tracking-[0.4em] leading-none mb-1">Live Editor</h1>
                    <p class="text-sm font-serif font-black text-[#EDD4B2] italic leading-none" x-text="form.title"></p>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('invitations.show', $invitation) }}" target="_blank" class="px-4 py-2.5 bg-white/5 text-slate-400 rounded-xl text-[10px] font-black uppercase tracking-widest border border-white/10 hover:bg-white/10 hover:text-white transition group">
                    <i class="fas fa-external-link-alt mr-2 group-hover:scale-110 transition"></i>
                    Lihat Publik
                </a>
                <div class="flex items-center gap-2 px-3 py-1.5 bg-emerald-500/10 rounded-full border border-emerald-500/20" x-show="isSaving">
                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Saving...</span>
                </div>
                <button @click="saveInvitation()" class="px-6 py-2.5 bg-rose-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-rose-900/20 hover:bg-rose-500 transition active:scale-95 disabled:opacity-50" :disabled="isSaving">
                    Simpan Perubahan
                </button>
            </div>
        </header>

        <div class="flex-1 flex overflow-hidden">
            <!-- Builder Sidebar (Vertical Nav + Settings) -->
            <aside class="flex w-[400px] border-r border-white/5 bg-slate-950">
                <!-- Vertical Nav Rail -->
                <nav class="w-16 flex flex-col items-center py-6 border-r border-white/5 gap-6 shrink-0 bg-slate-900/50">
                    <button @click="activeTab = 'general'" :class="activeTab === 'general' ? 'text-rose-500 scale-110 shadow-glow-rose' : 'text-slate-500 hover:text-white'" class="p-3 transition-all relative group" title="Umum">
                        <i class="fas fa-cog text-lg"></i>
                        <span class="absolute left-16 bg-slate-900 text-white text-[8px] font-black uppercase px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-[60]">Pengaturan Umum</span>
                    </button>
                    <button @click="activeTab = 'hero'" :class="activeTab === 'hero' ? 'text-rose-500 scale-110 shadow-glow-rose' : 'text-slate-500 hover:text-white'" class="p-3 transition-all relative group" title="Hero">
                        <i class="fas fa-star text-lg"></i>
                        <span class="absolute left-16 bg-slate-900 text-white text-[8px] font-black uppercase px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-[60]">Pembukaan (Hero)</span>
                    </button>
                    <button @click="activeTab = 'profile'" :class="activeTab === 'profile' ? 'text-rose-500 scale-110 shadow-glow-rose' : 'text-slate-500 hover:text-white'" class="p-3 transition-all relative group" title="Mempelai">
                        <i class="fas fa-user-friends text-lg"></i>
                        <span class="absolute left-16 bg-slate-900 text-white text-[8px] font-black uppercase px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-[60]">Pasangan Mempelai</span>
                    </button>
                    <button @click="activeTab = 'event'" :class="activeTab === 'event' ? 'text-rose-500 scale-110 shadow-glow-rose' : 'text-slate-500 hover:text-white'" class="p-3 transition-all relative group" title="Acara">
                        <i class="fas fa-calendar-day text-lg"></i>
                        <span class="absolute left-16 bg-slate-900 text-white text-[8px] font-black uppercase px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-[60]">Informasi Acara</span>
                    </button>
                    <button @click="activeTab = 'gallery'" :class="activeTab === 'gallery' ? 'text-rose-500 scale-110 shadow-glow-rose' : 'text-slate-500 hover:text-white'" class="p-3 transition-all relative group" title="Galeri">
                        <i class="fas fa-images text-lg"></i>
                        <span class="absolute left-16 bg-slate-900 text-white text-[8px] font-black uppercase px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-[60]">Galeri Foto</span>
                    </button>
                    <button @click="activeTab = 'story'" :class="activeTab === 'story' ? 'text-rose-500 scale-110 shadow-glow-rose' : 'text-slate-500 hover:text-white'" class="p-3 transition-all relative group" title="Cerita">
                        <i class="fas fa-heart text-lg"></i>
                        <span class="absolute left-16 bg-slate-900 text-white text-[8px] font-black uppercase px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-[60]">Kisah Cinta</span>
                    </button>
                    <button @click="activeTab = 'gift'" :class="activeTab === 'gift' ? 'text-rose-500 scale-110 shadow-glow-rose' : 'text-slate-500 hover:text-white'" class="p-3 transition-all relative group" title="Hadiah">
                        <i class="fas fa-gift text-lg"></i>
                        <span class="absolute left-16 bg-slate-900 text-white text-[8px] font-black uppercase px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-[60]">Kado Digital</span>
                    </button>
                    <button @click="activeTab = 'guestbook'" :class="activeTab === 'guestbook' ? 'text-rose-500 scale-110 shadow-glow-rose' : 'text-slate-500 hover:text-white'" class="p-3 transition-all relative group" title="Tamu">
                        <i class="fas fa-envelope-open-text text-lg"></i>
                        <span class="absolute left-16 bg-slate-900 text-white text-[8px] font-black uppercase px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-[60]">Moderasi Pesan</span>
                    </button>
                    <button @click="activeTab = 'style'" :class="activeTab === 'style' ? 'text-rose-500 scale-110 shadow-glow-rose' : 'text-slate-500 hover:text-white'" class="p-3 transition-all relative group" title="Desain">
                        <i class="fas fa-palette text-lg"></i>
                        <span class="absolute left-16 bg-slate-900 text-white text-[8px] font-black uppercase px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-[60]">Tema & Warna</span>
                    </button>
                </nav>

                <!-- Settings Content Panel -->
                <div class="flex-1 overflow-y-auto custom-scrollbar bg-slate-900/30">

                <!-- Form Sections -->
                <div class="p-6 space-y-8">
                    <!-- Hidden Uploader -->
                    <input type="file" x-ref="imageUploader" class="hidden" accept="image/*" @change="uploadImage($event)">

                    
                    <!-- Tab: Umum -->
                    <div x-show="activeTab === 'general'" class="space-y-6">
                        <h3 class="text-[11px] font-black text-white uppercase tracking-[0.3em] mb-4 border-b border-white/5 pb-2">Pengaturan Dasar</h3>
                        <div>
                            <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Judul Undangan</label>
                            <input type="text" x-model="form.title" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-rose-500/50 focus:ring-0 transition">
                        </div>
                        <div>
                            <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Slug URL</label>
                            <div class="flex items-center bg-white/5 border border-white/10 rounded-xl overflow-hidden">
                                <span class="pl-4 text-[10px] text-slate-500 italic">/undangan/</span>
                                <input type="text" x-model="form.slug" class="w-full bg-transparent border-none px-2 py-3 text-sm text-white focus:ring-0 transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Background Musik (SoundCloud/YouTube)</label>
                            <input type="text" x-model="form.data.general.music_url" placeholder="https://..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:ring-0">
                        </div>
                        <div>
                            <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Quote / Ayat</label>
                            <textarea x-model="form.data.general.quote" rows="4" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-rose-500/50 focus:ring-0 transition"></textarea>
                        </div>
                    </div>

                    <!-- Tab: Hero Section -->
                    <div x-show="activeTab === 'hero'" class="space-y-6">
                        <h3 class="text-[11px] font-black text-white uppercase tracking-[0.3em] mb-4 border-b border-white/5 pb-2">Halaman Pembuka (Hero)</h3>
                        <div>
                            <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Background Hero</label>
                            <div class="relative group aspect-video rounded-2xl overflow-hidden bg-white/5 border border-white/10 flex items-center justify-center cursor-pointer mb-2" @click="activeUploadPath = 'data.hero.background_image'; $refs.imageUploader.click()">
                                <template x-if="form.data.hero.background_image">
                                    <img :src="form.data.hero.background_image" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!form.data.hero.background_image">
                                    <div class="text-center group-hover:scale-110 transition duration-500">
                                        <i class="fas fa-image text-xl text-slate-400 mb-2"></i>
                                        <p class="text-[8px] font-black uppercase text-slate-500">Pilih Foto</p>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Font Judul Hero</label>
                            <select x-model="form.data.hero.title_font" class="w-full bg-slate-800 border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0">
                                <option value="font-script">Alex Brush (Default)</option>
                                <option value="font-greatvibes">Great Vibes (Elegant)</option>
                                <option value="font-pinyon">Pinyon Script (Formal)</option>
                                <option value="font-mea">Mea Culpa (Artistic)</option>
                                <option value="font-allison">Allison (Minimalist)</option>
                                <option value="font-parisienne">Parisienne (Romantic)</option>
                                <option value="font-cinzel">Cinzel (Imperial Serif)</option>
                                <option value="font-cormorant">Cormorant (Elegant Serif)</option>
                                <option value="font-serif">Playfair Display (Classy)</option>
                                <option value="font-garamond">EB Garamond (Editorial)</option>
                                <option value="font-outfit">Outfit (Modern Sans)</option>
                                <option value="font-sans">Montserrat (Geometric)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tab: Mempelai -->
                    <div x-show="activeTab === 'profile'" class="space-y-8">
                        <!-- Groom Details -->
                        <div class="space-y-6">
                            <div class="flex items-center justify-between mb-4 border-b border-white/5 pb-2">
                                <h3 class="text-[11px] font-black text-white uppercase tracking-[0.3em]">Mempelai Pria</h3>
                                <button @click="form.data.general.show_groom = !form.data.general.show_groom" 
                                        class="text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest transition"
                                        :class="form.data.general.show_groom !== false ? 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-500 border border-rose-500/20'">
                                    <span x-text="form.data.general.show_groom !== false ? 'Aktif' : 'Non-Aktif'"></span>
                                </button>
                            </div>
                            
                            <div class="space-y-4" x-show="form.data.general.show_groom !== false">
                                <div>
                                    <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Foto / Ilustrasi</label>
                                    <div class="relative group aspect-square rounded-2xl overflow-hidden bg-white/5 border border-white/10 flex items-center justify-center cursor-pointer mb-2" @click="activeUploadPath = 'data.groom.image'; $refs.imageUploader.click()">
                                        <template x-if="form.data.groom.image">
                                            <img :src="form.data.groom.image" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!form.data.groom.image">
                                            <div class="text-center group-hover:scale-110 transition duration-500">
                                                <i class="fas fa-camera text-xl text-slate-400 mb-2"></i>
                                                <p class="text-[8px] font-black uppercase text-slate-500">Pilih Foto</p>
                                            </div>
                                        </template>
                                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                            <p class="text-[9px] font-black uppercase text-white tracking-widest">Ganti Foto</p>
                                        </div>
                                    </div>
                                    <input type="text" x-model="form.data.groom.image" placeholder="Atau paste URL..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-[10px] text-white focus:ring-0">
                                </div>
                                <div>
                                    <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Nama Lengkap</label>
                                    <input type="text" x-model="form.data.groom.full_name" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:ring-0 transition">
                                </div>
                                <div>
                                    <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Nama Panggilan</label>
                                    <input type="text" x-model="form.groom_name" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:ring-0 transition">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Ayah</label>
                                        <input type="text" x-model="form.data.groom.father" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0 transition">
                                    </div>
                                    <div>
                                        <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Ibu</label>
                                        <input type="text" x-model="form.data.groom.mother" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0 transition">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Instagram (Tanpa @)</label>
                                    <input type="text" x-model="form.data.groom.instagram" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0 transition">
                                </div>
                            </div>
                        </div>

                        <!-- Bride Details -->
                        <div class="space-y-6 pt-6 border-t border-white/5">
                            <div class="flex items-center justify-between mb-4 border-b border-white/5 pb-2">
                                <h3 class="text-[11px] font-black text-white uppercase tracking-[0.3em]">Mempelai Wanita</h3>
                                <button @click="form.data.general.show_bride = !form.data.general.show_bride" 
                                        class="text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest transition"
                                        :class="form.data.general.show_bride !== false ? 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-500 border border-rose-500/20'">
                                    <span x-text="form.data.general.show_bride !== false ? 'Aktif' : 'Non-Aktif'"></span>
                                </button>
                            </div>
                            
                            <div class="space-y-4" x-show="form.data.general.show_bride !== false">
                                <div>
                                    <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Foto / Ilustrasi</label>
                                    <div class="relative group aspect-square rounded-2xl overflow-hidden bg-white/5 border border-white/10 flex items-center justify-center cursor-pointer mb-2" @click="activeUploadPath = 'data.bride.image'; $refs.imageUploader.click()">
                                        <template x-if="form.data.bride.image">
                                            <img :src="form.data.bride.image" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!form.data.bride.image">
                                            <div class="text-center group-hover:scale-110 transition duration-500">
                                                <i class="fas fa-camera text-xl text-slate-400 mb-2"></i>
                                                <p class="text-[8px] font-black uppercase text-slate-500">Pilih Foto</p>
                                            </div>
                                        </template>
                                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                            <p class="text-[9px] font-black uppercase text-white tracking-widest">Ganti Foto</p>
                                        </div>
                                    </div>
                                    <input type="text" x-model="form.data.bride.image" placeholder="Atau paste URL..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-[10px] text-white focus:ring-0">
                                </div>
                                <div>
                                    <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Nama Lengkap</label>
                                    <input type="text" x-model="form.data.bride.full_name" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:ring-0 transition">
                                </div>
                                <div>
                                    <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Nama Panggilan</label>
                                    <input type="text" x-model="form.bride_name" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:ring-0 transition">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Ayah</label>
                                        <input type="text" x-model="form.data.bride.father" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0 transition">
                                    </div>
                                    <div>
                                        <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Ibu</label>
                                        <input type="text" x-model="form.data.bride.mother" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0 transition">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Instagram (Tanpa @)</label>
                                    <input type="text" x-model="form.data.bride.instagram" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0 transition">
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Tab: Acara -->
                    <div x-show="activeTab === 'event'" class="space-y-6">
                        <div class="flex items-center justify-between mb-4 border-b border-white/5 pb-2">
                            <h3 class="text-[11px] font-black text-white uppercase tracking-[0.3em]">Informasi Acara</h3>
                            <button @click="form.data.general.show_event = !form.data.general.show_event" 
                                    class="text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest transition"
                                    :class="form.data.general.show_event !== false ? 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-500 border border-rose-500/20'">
                                <span x-text="form.data.general.show_event !== false ? 'Aktif' : 'Non-Aktif'"></span>
                            </button>
                        </div>
                        
                        <div class="space-y-6" x-show="form.data.general.show_event !== false">
                            <div>
                                <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Tanggal Akad & Resepsi</label>
                                <input type="datetime-local" x-model="form.event_date" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:ring-0 transition focus:border-rose-500/50">
                            </div>
                            <div>
                                <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Google Maps URL</label>
                                <input type="text" x-model="form.event_location" placeholder="https://maps.google.com/..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:ring-0 transition focus:border-rose-500/50">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Waktu Akad</label>
                                    <input type="text" x-model="form.data.event.akad_time" placeholder="08:00 - Selesai" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0">
                                </div>
                                <div>
                                    <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Waktu Resepsi</label>
                                    <input type="text" x-model="form.data.event.resepsi_time" placeholder="10:00 - Selesai" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Alamat Lengkap / Keterangan</label>
                                <textarea x-model="form.data.event.google_maps" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0" placeholder="Gedung Pernikahan X, Jl. Melati No. 123..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Tab: Galeri -->
                    <div x-show="activeTab === 'gallery'" class="space-y-6">
                        <div class="flex items-center justify-between mb-4 border-b border-white/5 pb-2">
                            <h3 class="text-[11px] font-black text-white uppercase tracking-[0.3em]">Galeri Foto</h3>
                            <button @click="form.data.general.show_gallery = !form.data.general.show_gallery" 
                                    class="text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest transition"
                                    :class="form.data.general.show_gallery !== false ? 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-500 border border-rose-500/20'">
                                <span x-text="form.data.general.show_gallery !== false ? 'Aktif' : 'Non-Aktif'"></span>
                            </button>
                        </div>

                        <div class="space-y-6" x-show="form.data.general.show_gallery !== false">
                            <div class="p-4 bg-white/5 border border-white/10 rounded-2xl space-y-4">
                                <h4 class="text-[10px] font-black text-rose-500 uppercase tracking-widest">Layout & Gaya Galeri</h4>
                                <div>
                                    <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Pilih Layout</label>
                                    <select x-model="form.data.gallery_style" class="w-full bg-slate-800 border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0">
                                        <option value="masonry">Masonry (Estetik Bertingkat)</option>
                                        <option value="grid">Grid (Kotak Seragam)</option>
                                        <option value="polaroid">Polaroid (Frame Klasik)</option>
                                        <option value="carousel">Carousel (Slide Horizontal)</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Dynamic Gallery Manager Preview -->
                            <div class="space-y-4">
                                <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Kelola Foto Galeri</label>

                                <!-- Editor Masonry/Grid -->
                                <div x-show="!form.data.gallery_style || form.data.gallery_style === 'masonry' || form.data.gallery_style === 'grid'" 
                                     class="grid grid-cols-2 gap-4">
                                    <template x-for="(img, index) in form.data.gallery" :key="index">
                                        <div class="relative group aspect-square rounded-xl overflow-hidden bg-white/5 border border-white/5 shadow-2xl">
                                            <img :src="img" class="w-full h-full object-cover">
                                            <button @click="removeFromGallery(index)" 
                                                    class="absolute top-2 right-2 w-6 h-6 bg-rose-600 text-white rounded-full text-[10px] flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-xl z-20">
                                                <i class="fas fa-trash text-[8px]"></i>
                                            </button>
                                        </div>
                                    </template>
                                </div>

                                <!-- Editor Polaroid -->
                                <div x-show="form.data.gallery_style === 'polaroid'" 
                                     class="grid grid-cols-2 gap-4">
                                    <template x-for="(img, index) in form.data.gallery" :key="index">
                                        <div class="relative group bg-white p-1 pb-4 shadow-xl transform rotate-1 group-hover:rotate-0 transition duration-500">
                                            <img :src="img" class="w-full aspect-square object-cover mb-1">
                                            <button @click="removeFromGallery(index)" 
                                                    class="absolute -top-1 -right-1 w-5 h-5 bg-rose-600 text-white rounded-full text-[8px] flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-xl z-20">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </template>
                                </div>

                                <!-- Editor Carousel -->
                                <div x-show="form.data.gallery_style === 'carousel'" 
                                     class="flex gap-4 overflow-x-auto pb-4 -mx-2 px-2 scrollbar-hide">
                                    <template x-for="(img, index) in form.data.gallery" :key="index">
                                        <div class="relative group flex-shrink-0 w-32 aspect-[4/5] rounded-xl overflow-hidden bg-white/5 border border-white/5">
                                            <img :src="img" class="w-full h-full object-cover">
                                            <button @click="removeFromGallery(index)" 
                                                    class="absolute top-2 right-2 w-6 h-6 bg-rose-600 text-white rounded-full text-[10px] flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-xl z-20">
                                                <i class="fas fa-trash text-[8px]"></i>
                                            </button>
                                        </div>
                                    </template>
                                </div>

                                <button @click="activeUploadPath = 'data.gallery.add'; $refs.imageUploader.click()" 
                                        class="w-full py-4 border-2 border-dashed border-white/10 rounded-xl flex flex-col items-center justify-center gap-2 hover:border-emerald-500/50 hover:text-emerald-500 transition text-slate-500 group">
                                    <i class="fas fa-plus text-lg group-hover:scale-125 transition duration-500"></i>
                                    <span class="text-[8px] font-black uppercase tracking-widest">Unggah Foto Baru</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tab: Cerita -->
                    <div x-show="activeTab === 'story'" class="space-y-6">
                        <div class="flex items-center justify-between mb-4 border-b border-white/5 pb-2">
                            <h3 class="text-[11px] font-black text-white uppercase tracking-[0.3em]">Kisah Cinta</h3>
                            <button @click="form.data.general.show_story = !form.data.general.show_story" 
                                    class="text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest transition"
                                    :class="form.data.general.show_story ? 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-500 border border-rose-500/20'">
                                <span x-text="form.data.general.show_story ? 'Aktif' : 'Non-Aktif'"></span>
                            </button>
                        </div>
                        
                        <div class="space-y-6" x-show="form.data.general.show_story">
                            <template x-for="(item, index) in form.data.story" :key="index">
                                <div class="p-4 bg-white/5 border border-white/5 rounded-2xl space-y-4 relative group">
                                    <button @click="form.data.story.splice(index, 1)" class="absolute -top-2 -right-2 w-6 h-6 bg-rose-600 text-white rounded-full text-[10px] flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-xl z-20">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <div>
                                        <label class="block text-[7px] font-black text-slate-500 uppercase tracking-widest mb-1">Tahun / Judul</label>
                                        <input type="text" x-model="item.year" class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-xs text-white focus:ring-0">
                                    </div>
                                    <div>
                                        <label class="block text-[7px] font-black text-slate-500 uppercase tracking-widest mb-1">Cerita Singkat</label>
                                        <textarea x-model="item.content" rows="2" class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-xs text-white focus:ring-0"></textarea>
                                    </div>
                                </div>
                            </template>
                            <button @click="form.data.story.push({ year: '', content: '' })" class="w-full py-4 border-2 border-dashed border-white/10 rounded-2xl text-[9px] font-black text-slate-400 uppercase tracking-widest hover:border-emerald-500/50 hover:text-emerald-500 transition">
                                <i class="fas fa-plus mr-2"></i> Tambah Kisah Baru
                            </button>
                        </div>
                    </div>

                    <!-- Tab: Hadiah -->
                    <div x-show="activeTab === 'gift'" class="space-y-6">
                        <div class="flex items-center justify-between mb-4 border-b border-white/5 pb-2">
                            <h3 class="text-[11px] font-black text-white uppercase tracking-[0.3em]">Kado Digital</h3>
                            <button @click="form.data.general.show_gift = !form.data.general.show_gift" 
                                    class="text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest transition"
                                    :class="form.data.general.show_gift ? 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-500 border border-rose-500/20'">
                                <span x-text="form.data.general.show_gift ? 'Aktif' : 'Non-Aktif'"></span>
                            </button>
                        </div>

                        <div class="space-y-4" x-show="form.data.general.show_gift">
                            <template x-for="(item, index) in (form.data.gifts || [])" :key="index">
                                <div class="p-4 bg-white/5 border border-white/5 rounded-2xl space-y-4 relative group">
                                    <button @click="form.data.gifts.splice(index, 1)" class="absolute -top-2 -right-2 w-6 h-6 bg-rose-600 text-white rounded-full text-[10px] flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-xl z-20">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <h4 class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Akun Kado #<span x-text="index + 1"></span></h4>
                                    <div>
                                        <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Nama Bank / E-Wallet</label>
                                        <input type="text" x-model="item.bank_name" placeholder="Contoh: BCA / DANA" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:ring-0">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Nomor Rekening</label>
                                            <input type="text" x-model="item.account_number" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0">
                                        </div>
                                        <div>
                                            <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Atas Nama</label>
                                            <input type="text" x-model="item.account_holder" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0">
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <button @click="if(!form.data.gifts) form.data.gifts = []; form.data.gifts.push({ bank_name: '', account_number: '', account_holder: '' })" 
                                    class="w-full py-4 border-2 border-dashed border-white/10 rounded-2xl text-[9px] font-black text-slate-400 uppercase tracking-widest hover:border-emerald-500/50 hover:text-emerald-500 transition">
                                <i class="fas fa-plus mr-2"></i> Tambah Rekening Baru
                            </button>
                        </div>
                    </div>

                    <!-- Tab: Guestbook -->
                    <div x-show="activeTab === 'guestbook'" class="space-y-6">
                        <div class="flex items-center justify-between mb-4 border-b border-white/5 pb-2">
                            <h3 class="text-[11px] font-black text-white uppercase tracking-[0.3em]">Manajemen Pesan</h3>
                            <button @click="form.data.general.show_rsvp = !form.data.general.show_rsvp" 
                                    class="text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest transition"
                                    :class="form.data.general.show_rsvp !== false ? 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-500 border border-rose-500/20'">
                                <span x-text="form.data.general.show_rsvp !== false ? 'Aktif' : 'Non-Aktif'"></span>
                            </button>
                        </div>

                        <div class="space-y-4" x-show="form.data.general.show_rsvp !== false">
                            @forelse($invitation->messages as $msg)
                                <div class="p-4 bg-white/5 border border-white/5 rounded-xl space-y-2 relative group hover:bg-white/10 transition">
                                    <div class="flex items-center justify-between">
                                        <h5 class="text-[10px] font-black text-white uppercase tracking-widest">{{ $msg->name }}</h5>
                                        <span class="text-[8px] font-bold {{ $msg->is_attending ? 'text-emerald-500' : 'text-rose-500' }} uppercase tracking-widest">{{ $msg->is_attending ? 'Hadir' : 'Absen' }}</span>
                                    </div>
                                    <p class="text-[10px] text-slate-400 italic">"{{ Str::limit($msg->message, 150) }}"</p>
                                    <button class="absolute -top-2 -right-2 w-6 h-6 bg-rose-600 text-white rounded-full text-[10px] flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-xl" onclick="confirm('Hapus pesan ini?') && document.getElementById('del-msg-{{ $msg->id }}').submit()">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="del-msg-{{ $msg->id }}" action="{{ route('messages.destroy', $msg->id) }}" method="POST" class="hidden">@csrf @method('DELETE')</form>
                                </div>
                            @empty
                                <div class="py-10 text-center opacity-20 italic text-xs uppercase tracking-widest">Belum ada ucapan dari tamu</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Tab: Desain -->
                    <div x-show="activeTab === 'style'" class="space-y-8">
                        <div class="border-b border-white/5 pb-4">
                            <h3 class="text-[11px] font-black text-white uppercase tracking-[0.3em]">Tema & Visual</h3>
                        </div>

                        <!-- Accent Color -->
                        <div class="space-y-4">
                            <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest">Warna Aksen Master</label>
                            <div class="flex items-center gap-4">
                                <div class="relative w-12 h-12 rounded-xl overflow-hidden border border-white/10">
                                    <input type="color" x-model="form.data.general.accent_color" class="absolute inset-0 scale-150 bg-transparent border-none cursor-pointer">
                                </div>
                                <input type="text" x-model="form.data.general.accent_color" class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-white uppercase font-mono transition focus:border-rose-500/50">
                            </div>
                        </div>

                        <!-- Global Typo -->
                        <div class="space-y-6 pt-6 border-t border-white/5">
                            <h4 class="text-[10px] font-black text-rose-500 uppercase tracking-[0.3em]">Tipografi Global</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Font Judul Utama</label>
                                    <select x-model="form.data.general.title_font" class="w-full bg-slate-800 border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0">
                                        <option value="font-script">Alex Brush (Default)</option>
                                        <option value="font-greatvibes">Great Vibes (Elegant)</option>
                                        <option value="font-pinyon">Pinyon Script (Formal)</option>
                                        <option value="font-mea">Mea Culpa (Artistic)</option>
                                        <option value="font-allison">Allison (Minimalist)</option>
                                        <option value="font-parisienne">Parisienne (Romantic)</option>
                                        <option value="font-cinzel">Cinzel (Imperial Serif)</option>
                                        <option value="font-cormorant">Cormorant (Elegant Serif)</option>
                                        <option value="font-serif">Playfair Display (Classy)</option>
                                        <option value="font-garamond">EB Garamond (Editorial)</option>
                                        <option value="font-outfit">Outfit (Modern Sans)</option>
                                        <option value="font-sans">Montserrat (Geometric)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[8px] font-black text-slate-500 uppercase tracking-widest mb-2">Font Konten Tubuh</label>
                                    <select x-model="form.data.general.body_font" class="w-full bg-slate-800 border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:ring-0">
                                        <option value="font-serif">Playfair Display (Serif)</option>
                                        <option value="font-garamond">EB Garamond (Serif)</option>
                                        <option value="font-cormorant">Cormorant (Serif)</option>
                                        <option value="font-outfit">Outfit (Sans)</option>
                                        <option value="font-sans">Montserrat (Sans)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </aside>

            <!-- Main Preview Container -->
            <main class="flex-1 bg-slate-950 p-4 md:p-8 flex flex-col relative">
                <!-- Toggle Device View -->
                <div class="absolute top-12 left-1/2 -translate-x-1/2 flex gap-1 p-1 bg-slate-900/80 backdrop-blur rounded-xl border border-white/10 z-10 shadow-2xl">
                    <button @click="view = 'mobile'" :class="view === 'mobile' ? 'bg-rose-500 text-white shadow-xl' : 'text-slate-400 hover:text-white'" class="p-2 w-10 rounded-lg transition duration-500">
                        <i class="fas fa-mobile-alt"></i>
                    </button>
                    <button @click="view = 'desktop'" :class="view === 'desktop' ? 'bg-rose-500 text-white shadow-xl' : 'text-slate-400 hover:text-white'" class="p-2 w-10 rounded-lg transition duration-500">
                        <i class="fas fa-desktop"></i>
                    </button>
                </div>

                <!-- Preview Wrapper -->
                <div class="flex-1 flex items-center justify-center transition-all duration-700" :class="view === 'mobile' ? 'max-w-[400px] mx-auto w-full' : 'w-full'">
                    <div class="w-full h-full bg-white rounded-3xl overflow-hidden shadow-[0_100px_150px_-50px_rgba(0,0,0,0.8)] border-[8px] border-slate-900 relative">
                        <iframe 
                            src="{{ route('invitations.show', $invitation) }}?preview=true" 
                            class="w-full h-full border-none"
                            x-ref="previewFrame"
                            @load="updatePreview()"
                        ></iframe>
                    </div>
                </div>
            </main>
        </div>
    </div>

    @push('scripts')
    <script>
        function invitationEditor() {
            return {
                view: 'mobile',
                activeTab: 'general',
                isSaving: false,
                activeUploadPath: null,
                tabs: [
                    { id: 'general', label: 'Umum' },
                    { id: 'profile', label: 'Mempelai' },
                    { id: 'event', label: 'Acara' },
                    { id: 'gallery', label: 'Galeri' },
                    { id: 'story', label: 'Cerita' },
                    { id: 'gift', label: 'Hadiah' },
                    { id: 'style', label: 'Desain' }
                ],
                form: {
                    title: @json($invitation->title),
                    slug: @json($invitation->slug),
                    groom_name: @json($invitation->groom_name),
                    bride_name: @json($invitation->bride_name),
                    event_date: @json($invitation->event_date ? $invitation->event_date->format('Y-m-d\TH:i') : ''),
                    event_location: @json($invitation->event_location),
                    data: @json($invitation->data)
                },

                init() {
                    // Ensure deep structure exists for legacy drafts
                    if (!this.form.data.story) this.form.data.story = [];
                    
                    // Migrate gift to gifts if needed
                    if (!this.form.data.gifts) {
                        if (this.form.data.gift) {
                            this.form.data.gifts = [this.form.data.gift];
                        } else {
                            this.form.data.gifts = [];
                        }
                    }

                    // Real-time sync to iframe
                    this.$watch('form', (value) => {
                        this.updatePreview();
                    }, { deep: true });
                },

                updatePreview() {
                    if (!this.$refs.previewFrame) return;
                    const iframe = this.$refs.previewFrame.contentWindow;
                    if (!iframe) return;
                    
                    iframe.postMessage({
                        type: 'UPDATE_DATA',
                        payload: JSON.parse(JSON.stringify(this.form))
                    }, '*');
                },

                setDeepValue(path, value) {
                    if (path.startsWith('data.gallery.add')) {
                        if (!this.form.data.gallery) this.form.data.gallery = [];
                        this.form.data.gallery.push(value);
                        return;
                    }
                    const keys = path.split('.');
                    let current = this.form;
                    for (let i = 0; i < keys.length - 1; i++) {
                        current = current[keys[i]];
                    }
                    current[keys[keys.length - 1]] = value;
                },

                removeFromGallery(index) {
                    this.form.data.gallery.splice(index, 1);
                    this.updatePreview();
                },

                async uploadImage(event) {
                    const file = event.target.files[0];
                    if (!file || !this.activeUploadPath) return;

                    const formData = new FormData();
                    formData.append('image', file);

                    try {
                        const response = await fetch("{{ route('invitations.upload', $invitation) }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        });

                        const result = await response.json();
                        if (result.success) {
                            this.setDeepValue(this.activeUploadPath, result.url);
                            this.updatePreview();
                            Toast.fire({ icon: 'success', title: 'Gambar berhasil diunggah!' });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Upload Gagal', text: result.error });
                        }
                    } catch (e) {
                        console.error(e);
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan sistem' });
                    } finally {
                        event.target.value = ''; // Reset input
                    }
                },

                async saveInvitation() {
                    this.isSaving = true;
                    try {
                        const response = await fetch("{{ route('invitations.save', $invitation) }}", {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(this.form)
                        });
                        
                        if (response.ok) {
                            // Minimal toast or visual feedback
                        }
                    } catch (error) {
                        console.error('Save failed', error);
                    } finally {
                        setTimeout(() => this.isSaving = false, 1000);
                    }
                }
            }
        }
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.05); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.1); }
        .shadow-glow-rose {
            filter: drop-shadow(0 0 8px rgba(225, 29, 72, 0.4));
        }
    </style>
    @endpush
</x-app-layout>
