<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Amora - Premium Digital Invitation</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        
        <style>
            body { font-family: 'Montserrat', sans-serif; background-color: #F8F9FA; -webkit-tap-highlight-color: transparent; }
            .font-serif { font-family: 'Cormorant Garamond', serif; }
            [x-cloak] { display: none !important; }
            
            /* Custom Scrollbar */
            ::-webkit-scrollbar { width: 5px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: #4D243D/20; border-radius: 10px; }
            ::-webkit-scrollbar-thumb:hover { background: #4D243D/40; }

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
            <div class="flex-1 flex flex-col min-w-0 {{ $isEditor ? 'bg-slate-950' : 'bg-[#F8F9FA]' }} overflow-y-auto min-h-screen relative" id="content-area">
                
                <!-- Premium Top Navbar -->
                @if(!$isEditor)
                    <nav class="glass-nav sticky top-0 z-40 border-b border-slate-200 h-16 md:h-20 flex items-center justify-between px-4 md:px-10 transition-all duration-300">
                    <div class="flex items-center gap-2 md:gap-6">
                        <!-- Sidebar Toggle Btn -->
                        <button @click="sidebarOpen = !sidebarOpen" class="w-10 h-10 md:w-12 md:h-12 rounded-2xl bg-slate-50 border border-slate-200 text-slate-400 hover:text-[#4D243D] hover:bg-white hover:shadow-xl transition-all duration-300 hidden md:flex items-center justify-center group">
                            <i class="fas" :class="sidebarOpen ? 'fa-indent' : 'fa-outdent'"></i>
                        </button>
                        
                        <!-- Mobile Hamburger -->
                        <button @click="mobileMenuOpen = true" class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-200 text-slate-400 hover:text-[#4D243D] md:hidden flex items-center justify-center">
                            <i class="fas fa-bars-staggered"></i>
                        </button>
                        
                        <!-- Page Title / Header Slot -->
                        @isset($header)
                            <div class="h-6 w-[1px] bg-slate-200 mx-1 md:mx-4 hidden sm:block"></div>
                            <div class="text-xs md:text-sm font-bold text-slate-900 italic transform transition-all duration-500 truncate max-w-[150px] md:max-w-none">
                                {{ $header }}
                            </div>
                        @else
                            <div class="h-6 w-[1px] bg-slate-200 mx-1 md:mx-4 hidden sm:block"></div>
                            <div class="text-[10px] md:text-xs font-black uppercase tracking-[0.2em] text-slate-400 italic">Amora Platform</div>
                        @endisset
                    </div>

                    <!-- Right Quick Actions -->
                    <div class="flex items-center gap-2 md:gap-6">
                        <!-- Quick Search (Visual Only) -->
                        <div class="hidden lg:flex items-center bg-slate-100/50 border border-slate-200 rounded-2xl px-4 py-2 text-slate-400 group focus-within:bg-white focus-within:shadow-lg transition-all duration-300">
                            <i class="fas fa-search text-xs mr-3"></i>
                            <input type="text" placeholder="Cari fitur..." class="bg-transparent border-none focus:ring-0 text-xs font-medium w-40 italic">
                        </div>

                        <!-- User Profile Dropdown Simulation -->
                        <div class="flex items-center gap-3 pl-2 md:border-l md:border-slate-200 md:pl-6">
                            <div class="text-right hidden sm:block">
                                <p class="text-[10px] font-black uppercase tracking-widest text-[#4D243D] leading-none">{{ Auth::user()->name }}</p>
                                <p class="text-[8px] text-slate-400 font-bold uppercase tracking-widest mt-1">{{ Auth::user()->role }} Mode</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="w-10 h-10 md:w-11 md:h-11 rounded-2xl bg-[#4D243D] text-[#EDD4B2] flex items-center justify-center font-bold shadow-xl border-2 border-white hover:scale-110 active:scale-95 transition duration-300">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </a>
                        </div>
                    </div>
                </nav>
                @endif

                <!-- Page Content Body -->
                <div class="flex-1 {{ $isEditor ? 'pb-0' : 'pb-24 md:pb-12' }}">
                    <main class="{{ $isEditor ? 'py-0' : 'py-6 md:py-10' }}">
                        {{ $slot }}
                    </main>
                </div>

                <!-- Mobile Bottom Navigation (Floating Premium) -->
                <div class="md:hidden fixed bottom-6 left-1/2 -translate-x-1/2 w-[90%] glass-nav rounded-3xl border border-slate-200 shadow-2xl z-[50] flex items-center justify-between p-2 pb-safe">
                    <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center w-1/4 py-2 transition {{ request()->is('dashboard') ? 'text-[#4D243D]' : 'text-slate-400 fill-slate-400' }}">
                        <i class="fas fa-home text-lg mb-1"></i>
                        <span class="text-[8px] font-black uppercase tracking-tighter">Beranda</span>
                        @if(request()->is('dashboard')) <div class="w-1 h-1 bg-[#4D243D] rounded-full mt-1"></div> @endif
                    </a>
                    <a href="{{ route('invitations.index') }}" class="flex flex-col items-center justify-center w-1/4 py-2 transition {{ request()->routeIs('invitations.*') ? 'text-[#4D243D]' : 'text-slate-400' }}">
                        <i class="fas fa-envelope text-lg mb-1"></i>
                        <span class="text-[8px] font-black uppercase tracking-tighter">Undangan</span>
                        @if(request()->routeIs('invitations.*')) <div class="w-1 h-1 bg-[#4D243D] rounded-full mt-1"></div> @endif
                    </a>
                    <a href="{{ route('packages.index') }}" class="flex flex-col items-center justify-center w-1/4 py-2 transition {{ request()->routeIs('packages.index') ? 'text-[#4D243D]' : 'text-slate-400' }}">
                        <div class="w-12 h-12 bg-[#4D243D] rounded-2xl flex items-center justify-center text-[#EDD4B2] shadow-xl -mt-8 border-4 border-[#F8F9FA]">
                            <i class="fas fa-gem text-lg"></i>
                        </div>
                        <span class="text-[8px] font-black uppercase tracking-tighter mt-1">Paket</span>
                    </a>
                    <a href="{{ route('themes.index') }}" class="flex flex-col items-center justify-center w-1/4 py-2 transition {{ request()->routeIs('themes.*') ? 'text-[#4D243D]' : 'text-slate-400' }}">
                        <i class="fas fa-magic text-lg mb-1"></i>
                        <span class="text-[8px] font-black uppercase tracking-tighter">Tema</span>
                        @if(request()->routeIs('themes.*')) <div class="w-1 h-1 bg-[#4D243D] rounded-full mt-1"></div> @endif
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center w-1/4 py-2 transition {{ request()->routeIs('profile.edit') ? 'text-[#4D243D]' : 'text-slate-400' }}">
                        <i class="fas fa-user-circle text-lg mb-1"></i>
                        <span class="text-[8px] font-black uppercase tracking-tighter">Profil</span>
                        @if(request()->routeIs('profile.edit')) <div class="w-1 h-1 bg-[#4D243D] rounded-full mt-1"></div> @endif
                    </a>
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
                Swal.fire({ icon: 'error', title: 'Oops...', text: "{{ session('error') }}", confirmButtonColor: '#4D243D' });
            @endif

            @if(session('warning'))
                Swal.fire({ icon: 'warning', title: 'Peringatan', text: "{{ session('warning') }}", confirmButtonColor: '#4D243D' });
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
                    confirmButtonColor: '#4D243D',
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
    </body>
</html>
