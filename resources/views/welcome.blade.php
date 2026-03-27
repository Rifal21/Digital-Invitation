<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Amora - Undangan Digital Eksklusif</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #ECDCC9; }
        .font-serif { font-family: 'Cormorant Garamond', serif; }
        .bg-amora-dark { background-color: #4D243D; }
        .text-amora-dark { color: #4D243D; }
        .bg-amora-tan { background-color: #D0A98F; }
        .text-amora-tan { color: #D0A98F; }
        .bg-amora-wheat { background-color: #EDD4B2; }
        .border-amora-tan { border-color: #D0A98F; }
        
        .hero-section {
            background-image: linear-gradient(to bottom, rgba(236, 220, 201, 0.7), rgba(236, 220, 201, 0.9)), url('/images/hero-bg.png');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="antialiased text-[#4D243D] selection:bg-amora-tan selection:text-white">

    <div class="relative min-h-screen">
        <!-- Navigation -->
        <nav class="absolute top-0 left-0 right-0 p-10 flex justify-between items-center z-50">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-amora-dark rounded-full flex items-center justify-center text-[#EDD4B2] shadow-2xl border border-white/10">
                    <span class="font-serif text-2xl font-bold">A</span>
                </div>
                <div class="text-3xl font-serif font-bold tracking-widest uppercase text-amora-dark">Amora</div>
            </div>
            <div class="hidden md:flex space-x-8 items-center">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-xs font-semibold uppercase tracking-widest hover:text-amora-tan transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-xs font-semibold uppercase tracking-widest hover:text-amora-tan transition">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-8 py-3 bg-amora-dark text-[#EDD4B2] text-[10px] font-bold uppercase tracking-[0.2em] rounded-full hover:scale-105 transition shadow-xl">Daftar Sekarang</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="hero-section flex items-center justify-center min-h-screen px-6 py-24 relative overflow-hidden">
            <div class="max-w-5xl mx-auto text-center relative z-10 transition-all duration-1000">
                <div class="inline-block py-1 px-4 mb-8 text-[10px] font-bold tracking-[0.4em] text-amora-dark uppercase border-b border-amora-dark animate-pulse">
                    Seni Merayakan Kebahagiaan
                </div>
                
                <h1 class="font-serif text-6xl md:text-[9.2rem] leading-[0.85] mb-12 tracking-tighter text-amora-dark">
                    Abadikan <br>
                    <span class="italic font-light opacity-80">Kisah</span> <br>
                    Cinta Anda.
                </h1>
                
                <p class="text-lg text-[#4D243D] mb-16 max-w-xl mx-auto leading-relaxed font-semibold tracking-wide uppercase text-[10px] bg-white/30 backdrop-blur-sm p-4 rounded-lg inline-block">
                    Undangan Digital Eksklusif untuk momen yang Tak Terlupakan. <br> Dirancang dengan kemewahan, dibagikan dengan penuh kasih.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-10">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-16 py-6 bg-amora-dark text-[#EDD4B2] rounded-full font-bold text-xs uppercase tracking-[0.3em] shadow-[0_20px_50px_rgba(77,36,61,0.3)] hover:-translate-y-2 transition-all">
                        Buat Sekarang
                    </a>
                    <a href="#explore" class="group flex items-center gap-4 text-amora-dark font-bold uppercase text-[9px] tracking-[0.4em] hover:opacity-70 transition">
                        Jelajahi Galeri
                        <div class="w-10 h-px bg-amora-dark group-hover:w-16 transition-all"></div>
                    </a>
                </div>

                <!-- Stats with glassmorphism for legibility -->
                <div class="mt-32 grid grid-cols-1 md:grid-cols-3 gap-20 border-t border-amora-dark/10 pt-16">
                    <div class="text-center group p-6 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 shadow-sm">
                        <div class="font-serif text-4xl group-hover:scale-110 transition">1.500+</div>
                        <div class="text-[9px] font-bold uppercase tracking-[0.3em] mt-3 opacity-60">Kisah Berbagi</div>
                    </div>
                    <div class="text-center group p-6 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 shadow-sm">
                        <div class="font-serif text-4xl group-hover:scale-110 transition">99.8%</div>
                        <div class="text-[9px] font-bold uppercase tracking-[0.3em] mt-3 opacity-60">Tingkat Kepuasan</div>
                    </div>
                    <div class="text-center group p-6 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 shadow-sm">
                        <div class="font-serif text-4xl group-hover:scale-110 transition">Alami</div>
                        <div class="text-[9px] font-bold uppercase tracking-[0.3em] mt-3 opacity-60">Nuansa Estetika</div>
                    </div>
                </div>
            </div>

            <!-- Background Decoration -->
            <div class="absolute top-[20%] right-[-5%] w-96 h-96 bg-amora-dark/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-[10%] left-[-5%] w-80 h-80 bg-amora-tan/20 rounded-full blur-3xl"></div>
        </main>

        <footer class="py-16 text-center text-amora-dark/30 text-[9px] font-bold uppercase tracking-[0.5em] bg-[#ECDCC9]">
            <p>© 2026 Amora Studio. Kemewahan Murni.</p>
        </footer>
    </div>
</body>
</html>
