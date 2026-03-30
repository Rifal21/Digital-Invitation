<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Memora By FKStudio - Premium Digital Invitation</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        
        @PwaHead
        
        <style>
            body { font-family: 'Montserrat', sans-serif; background-color: #FDFCFB; -webkit-tap-highlight-color: transparent; }
            .font-serif { font-family: 'Cormorant Garamond', serif; }
            [x-cloak] { display: none !important; }
            
            /* Custom Scrollbar */
            ::-webkit-scrollbar { width: 5px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: #0F172A/20; border-radius: 10px; }
            ::-webkit-scrollbar-thumb:hover { background: #0F172A/40; }

            .glass-nav { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
            
            /* Safe area for mobile notch */
            .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-900 overflow-x-hidden" x-data="{ sidebarOpen: window.innerWidth > 1024, mobileMenuOpen: false }">
        
        @php
            $isEditor = request()->routeIs('invitations.edit');
        @endphp

        <!-- Mobile Sidebar Overlay -->
        <div x-show="mobileMenuOpen" @click="mobileMenuOpen = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[55] md:hidden" x-cloak></div>

        <div class="flex h-screen overflow-hidden">
            
            <!-- Sidebar Component -->
            @if(!$isEditor)
                @include('layouts.sidebar')
            @endif

            <!-- Main Workspace -->
            <div class="flex-1 flex flex-col min-w-0 {{ $isEditor ? 'bg-slate-950' : 'bg-[#FDFCFB]' }} overflow-y-auto min-h-screen relative" id="content-area">
                
                <!-- Premium Top Navbar -->
                @if(!$isEditor)
                    <nav class="glass-nav sticky top-0 z-40 border-b border-slate-200/50 h-20 md:h-24 flex items-center justify-between px-6 md:px-12 transition-all duration-500 shadow-sm">
                        <div class="flex items-center gap-4 md:gap-8">
                            <!-- Sidebar Toggle Btn -->
                            <button @click="sidebarOpen = !sidebarOpen" 
                                class="w-11 h-11 md:w-14 md:h-14 rounded-[1.25rem] bg-white/50 border border-slate-200 text-slate-400 hover:text-[#0F172A] hover:bg-white hover:border-[#C5A267]/30 hover:shadow-[0_15px_35px_-5px_rgba(197,162,103,0.15)] transition-all duration-500 hidden md:flex items-center justify-center group">
                                <i class="fas" :class="sidebarOpen ? 'fa-align-left' : 'fa-align-justify'"></i>
                            </button>
                            
                            <!-- Mobile Hamburger - REMOVED per user request to remove mobile sidebar -->
                            {{-- <button @click="mobileMenuOpen = true" 
                                class="w-11 h-11 rounded-2xl bg-white/50 border border-slate-200 text-slate-400 hover:text-[#0F172A] md:hidden flex items-center justify-center transition-all duration-300">
                                <i class="fas fa-bars-staggered"></i>
                            </button> --}}
                            
                            <!-- Page Title / Header Slot -->
                            @isset($header)
                                <div class="h-8 w-px bg-slate-200/80 mx-2 md:mx-6 hidden sm:block"></div>
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-black uppercase tracking-[0.4em] text-slate-400 leading-none mb-1.5 opacity-60">Workspace</span>
                                    <h2 class="text-xs md:text-sm font-black text-[#0F172A] uppercase tracking-widest italic truncate max-w-[150px] md:max-w-none">
                                        {{ $header }}
                                    </h2>
                                </div>
                            @else
                                <div class="h-8 w-px bg-slate-200/80 mx-2 md:mx-6 hidden sm:block"></div>
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-black uppercase tracking-[0.4em] text-slate-400 leading-none mb-1.5 opacity-60">Memora Executive</span>
                                    <h2 class="text-xs md:text-sm font-black text-[#0F172A] uppercase tracking-widest italic">Dashboard Overview</h2>
                                </div>
                            @endisset
                        </div>

                        <!-- Right Actions -->
                        <div class="flex items-center gap-4 md:gap-10">
                            <!-- Quick Search (Refined) -->
                            <div class="hidden xl:flex items-center bg-slate-100/50 border border-slate-200 focus-within:border-[#C5A267]/30 rounded-[1.25rem] px-5 py-3 text-slate-400 group focus-within:bg-white focus-within:shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] transition-all duration-500 w-64">
                                <i class="fas fa-search text-[10px] mr-4 transition-colors group-focus-within:text-[#C5A267]"></i>
                                <input type="text" placeholder="Cari mahakarya..." class="bg-transparent border-none focus:ring-0 text-[11px] font-bold uppercase tracking-widest w-full placeholder:text-slate-300 placeholder:italic">
                            </div>

                            <!-- Notification & Theme Toggle placeholder -->
                            <div class="hidden md:flex items-center gap-3">
                                <button class="w-11 h-11 rounded-2xl border border-slate-200 text-slate-400 hover:text-[#C5A267] hover:border-[#C5A267]/20 transition-all duration-300">
                                    <i class="far fa-bell"></i>
                                </button>
                                <a href="/" target="_blank" class="w-11 h-11 rounded-2xl border border-slate-200 text-slate-400 hover:text-[#C5A267] hover:border-[#C5A267]/20 transition-all duration-300 flex items-center justify-center" title="Buka Landing Page">
                                    <i class="fas fa-external-link-alt text-[10px]"></i>
                                </a>
                            </div>

                            <!-- Integrated User Profile Dropdown -->
                            <div class="flex items-center gap-4 pl-4 md:border-l md:border-slate-100 md:pl-8" x-data="{ userMenuOpen: false }">
                                <div class="text-right hidden sm:block">
                                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-[#0F172A] leading-none mb-1">{{ Auth::user()->name }}</p>
                                    <div class="flex items-center justify-end gap-2">
                                        <div class="w-1.5 h-1.5 rounded-full bg-[#C5A267] animate-pulse"></div>
                                        <p class="text-[8px] text-slate-400 font-black uppercase tracking-[0.2em] opacity-60">{{ Auth::user()->role ?? 'Creator' }} Edition</p>
                                    </div>
                                </div>
                                
                                <div class="relative">
                                    <button @click="userMenuOpen = !userMenuOpen" @click.away="userMenuOpen = false" class="group relative outline-none">
                                        <div class="absolute -inset-1.5 bg-gradient-to-tr from-[#C5A267] to-[#e7c68a] rounded-[1.5rem] opacity-0 group-hover:opacity-20 blur-sm transition duration-500" :class="{ 'opacity-20': userMenuOpen }"></div>
                                        <div class="relative w-11 h-11 md:w-13 md:h-13 rounded-[1.25rem] bg-[#0F172A] text-[#C5A267] flex items-center justify-center font-serif text-lg font-black italic shadow-2xl border-2 border-white hover:scale-110 active:scale-95 transition-all duration-500" :class="{ 'scale-110 border-[#C5A267]/20': userMenuOpen }">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    </button>

                                    <!-- Premium Dropdown Menu -->
                                    <div x-show="userMenuOpen" 
                                        x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-y-4 scale-95" 
                                        x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
                                        x-transition:leave="transition ease-in duration-200 transform opacity-100 translate-y-0 scale-100" 
                                        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                                        class="absolute right-0 mt-6 w-64 bg-white/95 backdrop-blur-xl rounded-[2rem] shadow-[0_30px_70px_rgba(0,0,0,0.15)] border border-slate-100 overflow-hidden z-[100]"
                                        x-cloak>
                                        
                                        <div class="p-6 border-b border-slate-50 bg-slate-50/50">
                                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-[#0F172A]">{{ Auth::user()->name }}</p>
                                            <p class="text-[8px] text-slate-400 font-bold uppercase tracking-widest mt-1">{{ Auth::user()->email }}</p>
                                        </div>

                                        <div class="p-3">
                                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl text-slate-500 hover:text-[#0F172A] hover:bg-slate-50 transition-all duration-300">
                                                <div class="w-8 h-8 rounded-xl bg-slate-100 flex items-center justify-center text-[10px]">
                                                    <i class="fas fa-user-circle"></i>
                                                </div>
                                                <span class="text-[10px] font-black uppercase tracking-widest">Pengaturan Profil</span>
                                            </a>
                                            <a href="{{ route('invitations.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl text-slate-500 hover:text-[#0F172A] hover:bg-slate-50 transition-all duration-300">
                                                <div class="w-8 h-8 rounded-xl bg-slate-100 flex items-center justify-center text-[10px]">
                                                    <i class="fas fa-envelope-open-text"></i>
                                                </div>
                                                <span class="text-[10px] font-black uppercase tracking-widest">Mahakarya Saya</span>
                                            </a>
                                        </div>

                                        <div class="p-3 border-t border-slate-50 bg-slate-50/30">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="flex items-center gap-4 w-full px-4 py-3 rounded-2xl text-red-400 hover:text-white hover:bg-red-500 transition-all duration-300">
                                                    <div class="w-8 h-8 rounded-xl bg-red-50 flex items-center justify-center text-[10px] group-hover:bg-white/20">
                                                        <i class="fas fa-power-off"></i>
                                                    </div>
                                                    <span class="text-[10px] font-black uppercase tracking-widest text-left">Keluar Akun</span>
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </nav>
                @endif


                <!-- Page Content Body -->
                <div class="flex-1 {{ $isEditor ? 'pb-0' : 'pb-24 md:pb-12' }}">
                    <main class="{{ $isEditor ? 'py-0' : 'py-6 md:py-10 px-4 md:px-10 lg:px-12' }}">
                        {{ $slot }}
                    </main>
                </div>

                <!-- Mobile Bottom Navigation (Floating Premium) -->
                @if(!$isEditor)
                <div class="md:hidden fixed bottom-6 left-1/2 -translate-x-1/2 w-[92%] glass-nav rounded-[2.5rem] border border-slate-200/50 shadow-[0_25px_60px_rgba(15,23,42,0.2)] z-[60] flex items-center justify-around p-3 pb-safe">
                    <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center w-1/5 py-2 transition-all duration-500 {{ request()->is('dashboard') ? 'text-[#0F172A]' : 'text-slate-300' }}">
                        <i class="fas fa-home text-lg mb-1.5 {{ request()->is('dashboard') ? 'scale-110' : '' }}"></i>
                        <span class="text-[7px] font-black uppercase tracking-widest leading-none">Home</span>
                        @if(request()->is('dashboard')) <div class="w-1 h-1 bg-[#C5A267] rounded-full mt-1.5 animate-pulse"></div> @endif
                    </a>
                    <a href="{{ route('invitations.index') }}" class="flex flex-col items-center justify-center w-1/5 py-2 transition-all duration-500 {{ request()->routeIs('invitations.*') ? 'text-[#0F172A]' : 'text-slate-300 transition-all duration-500' }}">
                        <i class="fas fa-envelope-open-text text-lg mb-1.5 {{ request()->routeIs('invitations.*') ? 'scale-110' : '' }}"></i>
                        <span class="text-[7px] font-black uppercase tracking-widest leading-none">Invites</span>
                        @if(request()->routeIs('invitations.*')) <div class="w-1 h-1 bg-[#C5A267] rounded-full mt-1.5 animate-pulse"></div> @endif
                    </a>
                    
                    <!-- Center Action (More Menu Trigger) -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="relative -mt-10 outline-none group">
                        <div class="absolute -inset-3 bg-[#C5A267] rounded-[2rem] blur-xl opacity-0 group-active:opacity-40 transition-all duration-500"></div>
                        <div class="relative w-16 h-16 bg-[#0F172A] rounded-[1.5rem] flex items-center justify-center text-[#C5A267] shadow-[0_20px_40px_rgba(15,23,42,0.4)] border-4 border-white transition-transform duration-500 group-active:scale-95" :class="mobileMenuOpen ? 'rotate-180' : ''">
                            <i class="fas" :class="mobileMenuOpen ? 'fa-times' : 'fa-grid-2'"></i>
                            <i class="fas fa-grip-vertical text-xl" x-show="!mobileMenuOpen"></i>
                            <i class="fas fa-times text-xl" x-show="mobileMenuOpen" x-cloak></i>
                        </div>
                    </button>

                    <a href="{{ route('themes.index') }}" class="flex flex-col items-center justify-center w-1/5 py-2 transition-all duration-500 {{ request()->routeIs('themes.*') ? 'text-[#0F172A]' : 'text-slate-300' }}">
                        <i class="fas fa-palette text-lg mb-1.5 {{ request()->routeIs('themes.*') ? 'scale-110' : '' }}"></i>
                        <span class="text-[7px] font-black uppercase tracking-widest leading-none">Themes</span>
                        @if(request()->routeIs('themes.*')) <div class="w-1 h-1 bg-[#C5A267] rounded-full mt-1.5 animate-pulse"></div> @endif
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center w-1/5 py-2 transition-all duration-500 {{ request()->routeIs('profile.edit') ? 'text-[#0F172A]' : 'text-slate-300' }}">
                        <i class="fas fa-user-circle text-lg mb-1.5 {{ request()->routeIs('profile.edit') ? 'scale-110' : '' }}"></i>
                        <span class="text-[7px] font-black uppercase tracking-widest leading-none">Profile</span>
                        @if(request()->routeIs('profile.edit')) <div class="w-1 h-1 bg-[#C5A267] rounded-full mt-1.5 animate-pulse"></div> @endif
                    </a>
                </div>
                @endif

                <!-- Comprehensive Mobile Menu Overlay (Full Navigation) -->
                <div x-show="mobileMenuOpen" 
                    x-transition:enter="transition ease-out duration-500 transform"
                    x-transition:enter-start="translate-y-full opacity-0"
                    x-transition:enter-end="translate-y-0 opacity-100"
                    x-transition:leave="transition ease-in duration-400 transform"
                    x-transition:leave-start="translate-y-0 opacity-100"
                    x-transition:leave-end="translate-y-full opacity-0"
                    class="fixed inset-0 bg-[#0F172A] z-[58] overflow-y-auto px-8 pt-24 pb-48 md:hidden" x-cloak>
                    
                    <div class="mb-12">
                        <span class="text-[10px] font-black uppercase tracking-[0.6em] text-[#C5A267]/40 block mb-4">Navigasi Utama</span>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="{{ route('dashboard') }}" class="p-6 rounded-[2rem] bg-white/5 border border-white/5 flex flex-col gap-4 group transition-all">
                                <i class="fas fa-home text-2xl text-[#C5A267]"></i>
                                <span class="text-[11px] font-black uppercase tracking-widest text-white">Beranda</span>
                            </a>
                            <a href="{{ route('invitations.index') }}" class="p-6 rounded-[2rem] bg-white/5 border border-white/5 flex flex-col gap-4">
                                <i class="fas fa-envelope-open-text text-2xl text-[#C5A267]"></i>
                                <span class="text-[11px] font-black uppercase tracking-widest text-white">Undangan</span>
                            </a>
                            <a href="{{ route('packages.index') }}" class="p-6 rounded-[2rem] bg-white/5 border border-white/5 flex flex-col gap-4">
                                <i class="fas fa-gem text-2xl text-[#C5A267]"></i>
                                <span class="text-[11px] font-black uppercase tracking-widest text-white">Price List</span>
                            </a>
                            <a href="{{ route('themes.index') }}" class="p-6 rounded-[2rem] bg-white/5 border border-white/5 flex flex-col gap-4">
                                <i class="fas fa-palette text-2xl text-[#C5A267]"></i>
                                <span class="text-[11px] font-black uppercase tracking-widest text-white">Explore</span>
                            </a>
                        </div>
                    </div>

                    <div class="mb-12">
                        <span class="text-[10px] font-black uppercase tracking-[0.6em] text-[#C5A267]/40 block mb-4">Kelola Order</span>
                        <div class="space-y-3">
                            <a href="{{ route('transactions.history') }}" class="flex items-center justify-between p-6 rounded-[2rem] bg-white/5 border border-white/5">
                                <div class="flex items-center gap-5">
                                    <i class="fas fa-file-invoice-dollar text-xl text-[#C5A267]/60"></i>
                                    <span class="text-[11px] font-black uppercase tracking-widest text-white">Pesanan Saya</span>
                                </div>
                                <i class="fas fa-chevron-right text-[10px] text-white/20"></i>
                            </a>
                        </div>
                    </div>

                    @if(Auth::user()?->isAdmin())
                        <div class="mb-12">
                            <span class="text-[10px] font-black uppercase tracking-[0.6em] text-[#C5A267] block mb-6">Executive Panel</span>
                            <div class="grid grid-cols-1 gap-3">
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-5 p-5 rounded-2xl bg-[#C5A267] text-[#0F172A]">
                                    <i class="fas fa-chart-line text-xl"></i>
                                    <span class="text-[11px] font-black uppercase tracking-widest">Admin Dashboard</span>
                                </a>
                                <a href="{{ route('admin.themes.index') }}" class="flex items-center gap-5 p-5 rounded-2xl bg-white/5 border border-white/5 text-white">
                                    <i class="fas fa-layer-group text-xl text-[#C5A267]/60"></i>
                                    <span class="text-[11px] font-black uppercase tracking-widest">Manage Themes</span>
                                </a>
                                <a href="{{ route('admin.packages.index') }}" class="flex items-center gap-5 p-5 rounded-2xl bg-white/5 border border-white/5 text-white">
                                    <i class="fas fa-tags text-xl text-[#C5A267]/60"></i>
                                    <span class="text-[11px] font-black uppercase tracking-widest">Manage Packages</span>
                                </a>
                                <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-5 p-5 rounded-2xl bg-white/5 border border-white/5 text-white">
                                    <i class="fas fa-history text-xl text-[#C5A267]/60"></i>
                                    <span class="text-[11px] font-black uppercase tracking-widest">Order Logs</span>
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="mb-12">
                        <span class="text-[10px] font-black uppercase tracking-[0.6em] text-white/20 block mb-4">Akses Lainnya</span>
                        <div class="grid grid-cols-2 gap-3">
                             <a href="{{ route('profile.edit') }}" class="flex items-center gap-4 p-5 rounded-2xl bg-white/5 text-white/60">
                                <i class="fas fa-user-gear"></i>
                                <span class="text-[9px] font-bold uppercase tracking-widest">Settings</span>
                             </a>
                             <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="flex items-center gap-4 p-5 rounded-2xl bg-red-500/10 text-red-400 w-full">
                                    <i class="fas fa-power-off"></i>
                                    <span class="text-[9px] font-bold uppercase tracking-widest">Logout</span>
                                </button>
                             </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            AOS.init({ once: true, offset: 50 });

            // Global Notification Handler
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            @if(session('success'))
                Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
            @endif

            @if(session('error'))
                Swal.fire({ icon: 'error', title: 'Oops...', text: "{{ session('error') }}", confirmButtonColor: '#0F172A' });
            @endif

            @if(session('warning'))
                Swal.fire({ icon: 'warning', title: 'Peringatan', text: "{{ session('warning') }}", confirmButtonColor: '#0F172A' });
            @endif

            // Global Confirmation Helper
            window.confirmAction = function(event, message = 'Apakah Anda yakin?') {
                event.preventDefault();
                const form = event.target.closest('form');
                
                Swal.fire({
                    title: message,
                    text: "Tindakan ini tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0F172A',
                    cancelButtonColor: '#CBD5E1',
                    confirmButtonText: 'Ya, Lanjutkan!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-[2rem]',
                        confirmButton: 'rounded-xl px-8 py-3',
                        cancelButton: 'rounded-xl px-8 py-3'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        </script>
        @stack('scripts')
        @RegisterServiceWorkerScript
    </body>
</html>
