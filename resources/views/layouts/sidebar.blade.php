<aside 
    class="fixed inset-y-0 left-0 z-50 bg-[#0F172A] transition-all duration-500 md:relative translate-x-0 overflow-y-auto border-r border-white/5 shadow-2xl hidden md:flex flex-col group/sidebar"
    :class="{
        'w-72': sidebarOpen, 
        'w-0 md:w-20': !sidebarOpen,
        '-translate-x-full md:translate-x-0': !sidebarOpen
    }"
    x-cloak
>
    <!-- Logo Section -->
    <div class="p-5 flex items-center gap-4 border-b border-white/5 mb-6 overflow-hidden min-h-[100px]">
        <div class="w-10 h-10 bg-[#C5A267] rounded-xl flex shrink-0 items-center justify-center text-[#0F172A] shadow-2xl transition-transform hover:rotate-12 duration-500">
            <span class="font-bold text-xl font-serif">M</span>
        </div>
        <div x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="flex-1">
            <h2 class="text-lg font-bold font-serif text-[#C5A267] tracking-tighter uppercase leading-none whitespace-nowrap">Memora</h2>
            <p class="text-[8px] font-black tracking-[0.3em] uppercase text-white/50 mt-1 whitespace-nowrap">By FKStudio</p>
        </div>
        <!-- Close Mobile btn -->
        <button @click="mobileMenuOpen = false" class="ml-auto text-white/60 hover:text-white md:hidden">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <!-- Navigation Section -->
    <div class="flex-grow px-4 pb-10 space-y-10">
        
        <!-- User Menu Group -->
        <div x-data="{ open: true }">
            <button @click="open = !open" x-show="sidebarOpen || mobileMenuOpen" class="flex items-center justify-between w-full px-4 text-[9px] font-black uppercase tracking-[0.4em] text-white/50 mb-4 group hover:text-white/60 transition duration-300">
                <span>Core Services</span>
                <i class="fas fa-chevron-down text-[8px] transition-transform duration-500" :class="open ? '' : '-rotate-90'"></i>
            </button>
            <div x-show="open || !sidebarOpen" class="space-y-1">
                <a href="{{ route('dashboard') }}" class="relative flex items-center gap-4 px-5 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 group {{ request()->is('dashboard') ? 'bg-[#C5A267] text-[#0F172A] shadow-lg ring-1 ring-white/10' : 'text-[#C5A267]/70 hover:text-white hover:bg-white/5' }}">
                    @if(request()->is('dashboard'))
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full"></div>
                    @endif
                    <i class="fas fa-solar-panel w-5 shrink-0 {{ request()->is('dashboard') ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}"></i>
                    <span x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">Beranda</span>
                </a>
                <a href="{{ route('invitations.index') }}" class="relative flex items-center gap-4 px-5 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 group {{ request()->routeIs('invitations.*') ? 'bg-[#C5A267] text-[#0F172A] shadow-lg ring-1 ring-white/10' : 'text-[#C5A267]/70 hover:text-white hover:bg-white/5' }}">
                    @if(request()->routeIs('invitations.*'))
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full"></div>
                    @endif
                    <i class="fas fa-envelope-open-text w-5 shrink-0 {{ request()->routeIs('invitations.*') ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}"></i>
                    <span x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">My Invites</span>
                </a>
                <a href="{{ route('packages.index') }}" class="relative flex items-center gap-4 px-5 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 group {{ request()->routeIs('packages.index') ? 'bg-[#C5A267] text-[#0F172A] shadow-lg ring-1 ring-white/10' : 'text-[#C5A267]/70 hover:text-white hover:bg-white/5' }}">
                    @if(request()->routeIs('packages.index'))
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full"></div>
                    @endif
                    <i class="fas fa-gem w-5 shrink-0 {{ request()->routeIs('packages.index') ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}"></i>
                    <span x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">Daftar Harga</span>
                </a>
                <a href="{{ route('themes.index') }}" class="relative flex items-center gap-4 px-5 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 group {{ request()->routeIs('themes.index') ? 'bg-[#C5A267] text-[#0F172A] shadow-lg ring-1 ring-white/10' : 'text-[#C5A267]/70 hover:text-white hover:bg-white/5' }}">
                    @if(request()->routeIs('themes.index'))
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full"></div>
                    @endif
                    <i class="fas fa-palette w-5 shrink-0 {{ request()->routeIs('themes.index') ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}"></i>
                    <span x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">Lihat Tema</span>
                </a>
                <a href="{{ route('transactions.history') }}" class="relative flex items-center gap-4 px-5 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 group {{ request()->routeIs('transactions.history') ? 'bg-[#C5A267] text-[#0F172A] shadow-lg ring-1 ring-white/10' : 'text-[#C5A267]/70 hover:text-white hover:bg-white/5' }}">
                    @if(request()->routeIs('transactions.history'))
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full"></div>
                    @endif
                    <i class="fas fa-file-invoice-dollar w-5 shrink-0 {{ request()->routeIs('transactions.history') ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}"></i>
                    <span x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">Pesanan Saya</span>
                </a>
            </div>
        </div>

        <!-- Admin Management Group -->
        @if(Auth::user()?->isAdmin())
            <div x-data="{ open: true }">
            <button @click="open = !open" x-show="sidebarOpen || mobileMenuOpen" class="flex items-center justify-between w-full px-4 text-[9px] font-black uppercase tracking-[0.4em] text-white/50 mb-4 group hover:text-white/60 transition duration-300">
                <span>Executive Controls</span>
                <i class="fas fa-chevron-down text-[8px] transition-transform duration-500" :class="open ? '' : '-rotate-90'"></i>
            </button>
            <div x-show="open || !sidebarOpen" class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="relative flex items-center gap-4 px-5 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 group {{ request()->routeIs('admin.dashboard') ? 'bg-[#C5A267] text-[#0F172A] shadow-lg ring-1 ring-white/10' : 'text-[#C5A267]/70 hover:text-white hover:bg-white/5' }}">
                        @if(request()->routeIs('admin.dashboard'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full"></div>
                        @endif
                        <i class="fas fa-chart-pie w-5 shrink-0 {{ request()->routeIs('admin.dashboard') ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}"></i>
                        <span x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">Insight</span>
                    </a>
                    <a href="{{ route('admin.themes.index') }}" class="relative flex items-center gap-4 px-5 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 group {{ request()->routeIs('admin.themes.*') ? 'bg-[#C5A267] text-[#0F172A] shadow-lg ring-1 ring-white/10' : 'text-[#C5A267]/70 hover:text-white hover:bg-white/5' }}">
                        @if(request()->routeIs('admin.themes.*'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full"></div>
                        @endif
                        <i class="fas fa-layer-group w-5 shrink-0 {{ request()->routeIs('admin.themes.*') ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}"></i>
                        <span x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">Manage Themes</span>
                    </a>
                    <a href="{{ route('admin.packages.index') }}" class="relative flex items-center gap-4 px-5 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 group {{ request()->routeIs('admin.packages.*') ? 'bg-[#C5A267] text-[#0F172A] shadow-lg ring-1 ring-white/10' : 'text-[#C5A267]/70 hover:text-white hover:bg-white/5' }}">
                       @if(request()->routeIs('admin.packages.*'))
                           <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full"></div>
                       @endif
                       <i class="fas fa-tags w-5 shrink-0 {{ request()->routeIs('admin.packages.*') ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}"></i>
                       <span x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">Manage Packages</span>
                    </a>
                    <a href="{{ route('admin.transactions.index') }}" class="relative flex items-center gap-4 px-5 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 group {{ request()->routeIs('admin.transactions.*') ? 'bg-[#C5A267] text-[#0F172A] shadow-lg ring-1 ring-white/10' : 'text-[#C5A267]/70 hover:text-white hover:bg-white/5' }}">
                       @if(request()->routeIs('admin.transactions.*'))
                           <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full"></div>
                       @endif
                       <i class="fas fa-receipt w-5 shrink-0 {{ request()->routeIs('admin.transactions.*') ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}"></i>
                       <span x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">Log Transaksi</span>
                    </a>
                    <a href="{{ route('admin.payment-methods.index') }}" class="relative flex items-center gap-4 px-5 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 group {{ request()->routeIs('admin.payment-methods.*') ? 'bg-[#C5A267] text-[#0F172A] shadow-lg ring-1 ring-white/10' : 'text-[#C5A267]/70 hover:text-white hover:bg-white/5' }}">
                       @if(request()->routeIs('admin.payment-methods.*'))
                           <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full"></div>
                       @endif
                       <i class="fas fa-credit-card w-5 shrink-0 {{ request()->routeIs('admin.payment-methods.*') ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}"></i>
                       <span x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">Metode Bayar</span>
                    </a>
                    <a href="{{ route('admin.invitations.index') }}" class="relative flex items-center gap-4 px-5 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 group {{ request()->routeIs('admin.invitations.index') ? 'bg-[#C5A267] text-[#0F172A] shadow-lg ring-1 ring-white/10' : 'text-[#C5A267]/70 hover:text-white hover:bg-white/5' }}">
                        @if(request()->routeIs('admin.invitations.index'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full"></div>
                        @endif
                        <i class="fas fa-history w-5 shrink-0 {{ request()->routeIs('admin.invitations.index') ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}"></i>
                        <span x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">User Invites</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="relative flex items-center gap-4 px-5 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 group {{ request()->routeIs('admin.settings.*') ? 'bg-[#C5A267] text-[#0F172A] shadow-lg ring-1 ring-white/10' : 'text-[#C5A267]/70 hover:text-white hover:bg-white/5' }}">
                        @if(request()->routeIs('admin.settings.*'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full"></div>
                        @endif
                        <i class="fas fa-cog w-5 shrink-0 {{ request()->routeIs('admin.settings.*') ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}"></i>
                        <span x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">Pengaturan</span>
                    </a>
                </div>
            </div>
        @endif

        <!-- Profile & Settings Group -->
        <div x-data="{ open: true }">
            <button @click="open = !open" x-show="sidebarOpen || mobileMenuOpen" class="flex items-center justify-between w-full px-4 text-[9px] font-black uppercase tracking-[0.4em] text-white/50 mb-4 group hover:text-white/60 transition duration-300">
                <span>Account & Safety</span>
                <i class="fas fa-chevron-down text-[8px] transition-transform duration-500" :class="open ? '' : '-rotate-90'"></i>
            </button>
            <div x-show="open || !sidebarOpen" class="space-y-1">
                <a href="{{ route('profile.edit') }}" class="relative flex items-center gap-4 px-5 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 group {{ request()->routeIs('profile.edit') ? 'bg-[#C5A267] text-[#0F172A] shadow-lg ring-1 ring-white/10' : 'text-[#C5A267]/70 hover:text-white hover:bg-white/5' }}">
                    @if(request()->routeIs('profile.edit'))
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-6 bg-white rounded-r-full"></div>
                    @endif
                    <i class="fas fa-user-circle w-5 shrink-0 {{ request()->routeIs('profile.edit') ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}"></i>
                    <span x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">Profile Akun</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full gap-4 px-5 py-4 rounded-xl text-[11px] font-bold uppercase tracking-widest text-rose-300/70 hover:text-rose-400 hover:bg-rose-500/10 transition duration-300 group">
                        <i class="fas fa-sign-out-alt w-5 shrink-0 opacity-40 group-hover:opacity-100"></i>
                        <span x-show="sidebarOpen || mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="whitespace-nowrap">Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Sidebar Footer -->
    <div class="px-8 pb-8 pt-4 overflow-hidden" x-show="sidebarOpen || mobileMenuOpen">
        <div class="bg-white/5 p-5 rounded-2xl border border-white/5 group hover:border-[#C5A267]/20 transition duration-700">
            <h4 class="text-[#C5A267] font-black text-[9px] uppercase tracking-widest mb-1.5">Memora Pro v.1.2</h4>
            <p class="text-[8px] text-white/40 font-bold uppercase leading-relaxed italic">The most sophisticated invitation system.</p>
        </div>
    </div>
</aside>
