<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Katalog Tema Eksklusif - Amora Studio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #FDFBFA; color: #4D243D; }
        .font-serif { font-family: 'Cormorant Garamond', serif; }
        [x-cloak] { display: none !important; }
        
        .theme-card-frame {
            aspect-ratio: 4/5;
            width: 100%;
            border-radius: 3rem;
            background: #fff;
            overflow: hidden;
            position: relative;
            box-shadow: 0 20px 60px rgba(77, 36, 61, 0.05);
            border: 1px solid rgba(77, 36, 61, 0.03);
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .theme-card-frame:hover {
            transform: translateY(-1.5rem) scale(1.03);
            box-shadow: 0 50px 100px rgba(77, 36, 61, 0.15);
        }

        .glass-overlay {
            background: rgba(77, 36, 61, 0.8);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
        }

        .nav-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .gold-glow { box-shadow: 0 10px 40px rgba(212, 175, 55, 0.2); }
    </style>
</head>
<body class="antialiased overflow-x-hidden">

    <!-- Premium Header Area -->
    <nav class="nav-glass sticky top-0 z-[100] border-b border-slate-100/50 flex justify-between items-center px-6 md:px-20 h-20 md:h-24 shadow-sm">
        <a href="/" class="flex items-center gap-4 group">
            <div class="w-10 h-10 md:w-12 md:h-12 bg-[#4D243D] rounded-2xl flex items-center justify-center text-[#EDD4B2] shadow-2xl transition-transform group-hover:rotate-12 duration-500">
                <span class="font-serif text-xl md:text-2xl font-bold italic">A</span>
            </div>
            <div>
                <span class="text-xl md:text-2xl font-serif font-black tracking-widest uppercase leading-none block">Amora</span>
                <p class="text-[8px] font-black tracking-[0.4em] opacity-30 uppercase mt-1">Exquisite Themes</p>
            </div>
        </a>
        
        <div class="flex items-center gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 bg-[#4D243D] text-[#EDD4B2] px-6 py-3 rounded-2xl shadow-xl hover:scale-105 active:scale-95 transition-all text-[9px] font-black uppercase tracking-widest">
                    <i class="fas fa-solar-panel"></i>
                    <span>Kembali ke Dashboard</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-widest px-6 py-3 text-[#4D243D] hover:bg-slate-50 rounded-2xl transition">Masuk</a>
                <a href="{{ route('register') }}" class="hidden sm:block text-[10px] font-black uppercase tracking-widest px-8 py-3 bg-[#4D243D] text-[#EDD4B2] rounded-2xl shadow-xl hover:bg-slate-900 hover:scale-105 active:scale-95 transition-all">Daftar Sekarang</a>
            @endauth
        </div>
    </nav>

    <!-- Luxury Intro -->
    <header class="relative pt-32 pb-20 md:pt-48 md:pb-32 text-center overflow-hidden">
        <!-- Floating Elements Decor -->
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-emerald-500/5 rounded-full blur-[100px]"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-[#4D243D]/5 rounded-full blur-[100px]"></div>

        <div class="max-w-5xl mx-auto px-8 relative z-10" data-aos="fade-up">
            <span class="inline-flex items-center gap-3 text-[#4D243D]/30 font-black uppercase tracking-[0.6em] text-[10px] mb-8 py-2 px-6 rounded-full border border-[#4D243D]/10 bg-white/50">
                <i class="fas fa-crown text-[8px]"></i>
                Curated Collection 2026
            </span>
            <h1 class="font-serif text-5xl md:text-8xl font-black mb-10 leading-[1.1] tracking-tight text-slate-800">
                Lahir dari <span class="italic text-slate-300">Seni</span>, <br>
                Dirancang untuk <span class="text-[#4D243D] italic">Cinta.</span>
            </h1>
            <p class="max-w-2xl mx-auto text-slate-500 text-lg md:text-xl font-medium italic leading-relaxed opacity-80">
                Pilih mahakarya desain kami yang akan menjadi saksi bisu keindahan janji suci dan perjalanan cinta abadi Anda.
            </p>
            <div class="w-16 h-1.5 bg-[#EDD4B2] mx-auto mt-16 rounded-full shadow-lg opacity-40"></div>
        </div>
    </header>

    <!-- Main Exhibition Gallery -->
    <main class="max-w-7xl mx-auto px-6 md:px-12 pb-48">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 md:gap-20">
            @forelse($themes as $theme)
                <div class="group relative" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    
                    <!-- Premium Theme Card -->
                    <div class="theme-card-frame mb-10 relative group">
                        <!-- Theme Screenshot/Visual Preview -->
                        <div class="w-full h-full relative transition duration-1000 group-hover:scale-110">
                            @if($theme->preview_image)
                                <img src="{{ asset('storage/' . $theme->preview_image) }}" class="w-full h-full object-cover">
                            @else
                                <!-- High-end Silhoutte if No Image -->
                                <div class="w-full h-full p-12 flex flex-col justify-center items-center text-center space-y-8 bg-gradient-to-br from-[#FDFBFA] to-[#F5EFE9]">
                                    <div class="w-24 h-24 rounded-full border border-[#4D243D]/5 flex items-center justify-center relative">
                                        <i class="fas fa-leaf text-4xl opacity-10 rotate-12" style="color: {{ $theme->color }}"></i>
                                        <div class="absolute inset-0 rounded-full animate-ping opacity-5 border border-[#4D243D]/20"></div>
                                    </div>
                                    <div>
                                        <h4 class="font-serif text-4xl italic text-[#4D243D]/80 mb-2">{{ $theme->name }}</h4>
                                        <p class="text-[8px] uppercase tracking-[0.5em] font-black opacity-30">Series {{ $loop->iteration }}</p>
                                    </div>
                                    <div class="h-px w-16 bg-[#4D243D]/10"></div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Premium Interactive Overlay -->
                        <div class="glass-overlay absolute inset-0 opacity-0 group-hover:opacity-100 transition-all duration-700 flex flex-col justify-center items-center p-12 translate-y-full group-hover:translate-y-0 shadow-2xl">
                            <i class="fas fa-expand-arrows-alt text-[#EDD4B2] text-4xl mb-10 transform -translate-y-10 group-hover:translate-y-0 transition-transform duration-1000 opacity-50"></i>
                            
                            <div class="space-y-4 w-full px-4">
                                <a href="{{ route('themes.preview', $theme->slug) }}" target="_blank" class="block w-full py-5 bg-[#EDD4B2] text-[#4D243D] text-[10px] font-black uppercase tracking-[0.4em] rounded-[2rem] shadow-2xl hover:bg-white hover:scale-105 transition-all duration-500 text-center">
                                    <i class="fas fa-play text-[8px] mr-2 opacity-50"></i> Live Preview
                                </a>
                                @auth
                                    @if(Auth::user()->invitations()->where('theme', $theme->slug)->exists())
                                        <div class="py-4 text-white text-[9px] font-black uppercase tracking-widest text-center opacity-70">
                                            <i class="fas fa-check-circle mr-1"></i> Sedang Digunakan
                                        </div>
                                    @else
                                        <form action="{{ route('invitations.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="theme" value="{{ $theme->slug }}">
                                            <button type="submit" class="w-full py-5 bg-transparent border-2 border-white/20 text-white text-[10px] font-black uppercase tracking-[0.4em] rounded-[2rem] hover:bg-white hover:text-[#4D243D] hover:border-white transition-all duration-500">
                                                Gunakan Sekarang
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('register', ['theme' => $theme->slug]) }}" class="block w-full py-5 bg-transparent border-2 border-white/20 text-white text-[10px] font-black uppercase tracking-[0.4em] rounded-[2rem] hover:bg-white hover:text-[#4D243D] hover:border-white transition-all duration-500 text-center">
                                        Pesan Tema Ini
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>

                    <!-- External Metadata -->
                    <div class="text-center">
                         <div class="flex items-center justify-center gap-4 mb-6">
                              <span class="text-[8px] font-black uppercase tracking-[0.4em] px-5 py-2 rounded-full border border-slate-100 bg-white shadow-sm text-slate-400">
                                 Collection 2026
                              </span>
                              <div class="w-2 h-2 rounded-full animate-pulse" style="background-color: {{ $theme->color }}"></div>
                         </div>
                         <h3 class="font-serif text-4xl font-black text-[#4D243D] mb-4 tracking-tighter">{{ $theme->name }}</h3>
                         <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mb-4 italic max-w-[200px] mx-auto leading-relaxed">{{ $theme->description }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-32 text-center">
                    <i class="fas fa-box-open text-5xl text-slate-200 mb-6"></i>
                    <p class="text-slate-400 font-serif text-xl italic">Belum ada tema premium yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </main>

    <!-- Grand Footer -->
    <footer class="py-32 bg-[#4D243D] text-center border-t border-white/5 relative overflow-hidden">
        <div class="absolute -bottom-40 -left-40 w-[500px] h-[500px] bg-white/5 rounded-full blur-[120px]"></div>
        <div class="absolute -top-40 -right-40 w-[400px] h-[400px] bg-[#EDD4B2]/5 rounded-full blur-[100px]"></div>
        
        <div class="relative z-10 flex flex-col items-center">
            <div class="w-16 h-16 bg-white/5 rounded-[2rem] flex items-center justify-center text-[#EDD4B2] mb-12 border border-white/10 group hover:rotate-12 transition-transform duration-1000 shadow-2xl">
                <span class="font-serif text-3xl font-bold italic">A</span>
            </div>
            
            <h4 class="text-white font-serif text-3xl italic mb-6">Amora Digital Studio</h4>
            <div class="flex gap-8 mb-12 opacity-30 group">
                <i class="fab fa-instagram text-white hover:text-[#EDD4B2] transition cursor-pointer"></i>
                <i class="fab fa-whatsapp text-white hover:text-[#EDD4B2] transition cursor-pointer"></i>
                <i class="fab fa-tiktok text-white hover:text-[#EDD4B2] transition cursor-pointer"></i>
            </div>

            <p class="text-white/20 text-[9px] font-black tracking-[0.6em] uppercase italic">
                © 2026 Amora Inc. Reserved for Perfection.
            </p>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ 
            duration: 1000,
            once: true,
            offset: 100
        });
    </script>
</body>
</html>
