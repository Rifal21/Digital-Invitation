<x-app-layout>
    <x-slot name="header">
        Manajemen Tamu: {{ $invitation->title }}
    </x-slot>

    <div class="py-6" x-data="{ 
        showAddModal: false, 
        showImportModal: false,
        showEditModal: false,
        editGuest: { name: '', phone: '', group: '' },
        search: '{{ $search }}',
        isLoading: false,
        isInfiniteLoading: false,
        
        init() {
            this.setupObserver();
        },

        setupObserver() {
            const observer = new IntersectionObserver((entries) => {
                const trigger = entries[0];
                if (trigger.isIntersecting && !this.isInfiniteLoading) {
                    this.loadMore();
                }
            }, { threshold: 0.1 });

            const triggerEl = document.getElementById('load-more-trigger');
            if (triggerEl) observer.observe(triggerEl);
        },

        updateList() {
            this.isLoading = true;
            fetch(`${window.location.pathname}?search=${this.search}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('guest-grid').innerHTML = html;
                    this.isLoading = false;
                    this.setupObserver();
                });
        },

        loadMore() {
            const trigger = document.getElementById('load-more-trigger');
            if (!trigger) return;
            
            const nextUrl = trigger.dataset.nextUrl;
            if (!nextUrl) return;

            this.isInfiniteLoading = true;
            fetch(nextUrl, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(response => response.text())
                .then(html => {
                    trigger.remove();
                    document.getElementById('guest-grid').insertAdjacentHTML('beforeend', html);
                    this.isInfiniteLoading = false;
                    this.setupObserver();
                });
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Strategic Header & Search -->
            <div class="space-y-8" data-aos="fade-down">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
                    <div>
                        <h2
                            class="font-serif text-3xl md:text-4xl font-black text-[#0F172A] mb-2 uppercase tracking-tight italic">
                            Daftar Tamu Kehormatan</h2>
                        <p class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400">
                            Total: <span class="text-[#0F172A]">{{ $invitation->guests->count() }}</span> Terdaftar
                            @if ($search)
                                | Hasil pencarian untuk: <span class="text-[#C5A267]">"{{ $search }}"</span>
                            @endif
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                        <button @click="showImportModal = true"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-3 bg-emerald-50 text-emerald-600 px-8 py-4 rounded-xl text-[9px] font-black uppercase tracking-[0.3em] hover:bg-emerald-100 transition-all">
                            <i class="fas fa-file-excel"></i>
                            Import
                        </button>
                        <button @click="showAddModal = true"
                            class="flex-1 lg:flex-none flex items-center justify-center gap-3 bg-[#0F172A] text-[#C5A267] px-8 py-4 rounded-xl text-[9px] font-black uppercase tracking-[0.3em] shadow-lg hover:scale-105 active:scale-95 transition-all">
                            <i class="fas fa-plus"></i>
                            Tambah
                        </button>
                    </div>
                </div>

                <!-- Live Search Bar -->
                <div class="flex items-center gap-3 max-w-xl group relative">
                    <div class="flex-1 relative">
                        <div class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-[#C5A267] transition-colors">
                            <i class="fas fa-search text-[10px]"></i>
                        </div>
                        <input type="text" x-model="search"
                            @keyup.enter="updateList()"
                            placeholder="Cari nama, grup, atau nomor..."
                            class="w-full pl-14 pr-12 py-4 rounded-2xl border-slate-100 bg-white shadow-sm focus:border-[#C5A267] focus:ring-0 text-[10px] font-bold uppercase tracking-widest placeholder:text-slate-300 transition-all">
                        <template x-if="search">
                            <button @click="search = ''; updateList()" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 hover:text-red-500 transition">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </template>
                    </div>
                    <button @click="updateList()" class="bg-[#0F172A] text-[#C5A267] px-8 py-4 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] shadow-lg hover:scale-105 active:scale-95 transition-all flex items-center gap-3">
                        <template x-if="isLoading">
                            <i class="fas fa-spinner fa-spin"></i>
                        </template>
                        Cari
                    </button>
                </div>
            </div>

            <div id="guest-table" class="space-y-6">
                <!-- Guest List Grid -->
                <div id="guest-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @include('invitations.partials.guest-list')
                </div>
            </div>
        </div>

        <!-- Add Guest Modal -->
        <div x-show="showAddModal" x-cloak
            class="fixed inset-0 z-[500] flex items-center justify-center p-6 bg-[#0F172A]/80 backdrop-blur-sm"
            x-transition>
            <div class="bg-white w-full max-w-xl rounded-[3rem] shadow-2xl overflow-hidden p-10 md:p-12"
                @click.away="showAddModal = false">
                <div class="flex justify-between items-center mb-10">
                    <h3 class="font-serif text-3xl font-black text-[#0F172A] italic">Registrasi Tamu</h3>
                    <button @click="showAddModal = false" class="text-slate-300 hover:text-red-500 transition">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form action="{{ route('guests.store', $invitation) }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Nama Lengkap
                            Tamu</label>
                        <input type="text" name="name" required placeholder="Contoh: Budi Santoso"
                            class="w-full px-8 py-5 rounded-2xl border-slate-100 bg-slate-50 focus:border-[#C5A267] focus:ring-0 text-sm font-bold placeholder:text-slate-300 transition-all">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">WhatsApp
                                / HP</label>
                            <input type="text" name="phone" placeholder="Contoh: 081234..."
                                class="w-full px-8 py-5 rounded-2xl border-slate-100 bg-slate-50 focus:border-[#C5A267] focus:ring-0 text-sm font-bold placeholder:text-slate-300 transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Grup /
                                Kategori</label>
                            <input type="text" name="group" placeholder="Keluarga, Kantor, dsb"
                                class="w-full px-8 py-5 rounded-2xl border-slate-100 bg-slate-50 focus:border-[#C5A267] focus:ring-0 text-sm font-bold placeholder:text-slate-300 transition-all">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-5 bg-[#0F172A] text-[#C5A267] rounded-2xl text-[10px] font-black uppercase tracking-[0.4em] shadow-xl hover:bg-slate-900 transition-all duration-500">
                        Simpan Data Tamu
                    </button>
                </form>
            </div>
        </div>

        <!-- Edit Guest Modal -->
        <div x-show="showEditModal" x-cloak
            class="fixed inset-0 z-[500] flex items-center justify-center p-6 bg-[#0F172A]/80 backdrop-blur-sm"
            x-transition>
            <div class="bg-white w-full max-w-xl rounded-[3rem] shadow-2xl overflow-hidden p-10 md:p-12"
                @click.away="showEditModal = false">
                <div class="flex justify-between items-center mb-10">
                    <h3 class="font-serif text-3xl font-black text-[#0F172A] italic">Edit Data Tamu</h3>
                    <button @click="showEditModal = false" class="text-slate-300 hover:text-red-500 transition">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form :action="`/guests/${editGuest.id}`" method="POST" class="space-y-8">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Nama Lengkap Tamu</label>
                        <input type="text" name="name" x-model="editGuest.name" required class="w-full px-8 py-5 rounded-2xl border-slate-100 bg-slate-50 focus:border-[#C5A267] focus:ring-0 text-sm font-bold transition-all">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">WhatsApp / HP</label>
                            <input type="text" name="phone" x-model="editGuest.phone" class="w-full px-8 py-5 rounded-2xl border-slate-100 bg-slate-50 focus:border-[#C5A267] focus:ring-0 text-sm font-bold transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Grup / Kategori</label>
                            <input type="text" name="group" x-model="editGuest.group" class="w-full px-8 py-5 rounded-2xl border-slate-100 bg-slate-50 focus:border-[#C5A267] focus:ring-0 text-sm font-bold transition-all">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-5 bg-[#0F172A] text-[#C5A267] rounded-2xl text-[10px] font-black uppercase tracking-[0.4em] shadow-xl hover:bg-slate-900 transition-all duration-500">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        <!-- Import Guest Modal -->
        <div x-show="showImportModal" x-cloak
            class="fixed inset-0 z-[500] flex items-center justify-center p-6 bg-[#0F172A]/80 backdrop-blur-sm"
            x-transition>
            <div class="bg-white w-full max-w-xl rounded-[3rem] shadow-2xl overflow-hidden p-10 md:p-12"
                @click.away="showImportModal = false">
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h3 class="font-serif text-3xl font-black text-[#0F172A] italic">Import via Excel</h3>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-slate-400 mt-2">Gunakan template
                            untuk format yang sesuai</p>
                    </div>
                    <button @click="showImportModal = false" class="text-slate-300 hover:text-red-500 transition">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div
                    class="mb-10 p-6 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600">
                            <i class="fas fa-download"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-[#0F172A]">Template Excel
                            </p>
                            <p class="text-[8px] font-bold text-slate-400 uppercase mt-0.5">XLSX Format</p>
                        </div>
                    </div>
                    <a href="{{ route('guests.template') }}"
                        class="px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-xl text-[9px] font-black uppercase tracking-widest hover:border-emerald-500 hover:text-emerald-600 transition-all">
                        Unduh
                    </a>
                </div>

                <form action="{{ route('guests.import', $invitation) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <div class="space-y-4">
                        <label class="block">
                            <span class="sr-only">Pilih file Excel</span>
                            <div
                                class="relative group/upload bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] p-10 text-center hover:border-[#C5A267]/30 transition duration-700 cursor-pointer">
                                <i
                                    class="fas fa-cloud-upload-alt text-3xl text-slate-300 mb-4 group-hover/upload:text-[#C5A267] transition"></i>
                                <p class="text-[10px] font-black uppercase tracking-widest text-[#0F172A]">Klik atau
                                    seret file ke sini</p>
                                <p class="text-[8px] font-bold text-slate-400 uppercase mt-2">Maksimal 2MB (xlsx, xls,
                                    csv)</p>
                                <input type="file" name="file" required
                                    class="absolute inset-0 opacity-0 cursor-pointer text-[0px]">
                            </div>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full py-5 bg-[#0F172A] text-[#C5A267] rounded-2xl text-[10px] font-black uppercase tracking-[0.4em] shadow-xl hover:bg-slate-900 transition-all duration-500">
                        Proses Import Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
