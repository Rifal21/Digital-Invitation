<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: true, mobileMenu: false, scrolled: false }"
    @scroll.window="scrolled = (window.pageYOffset > 20)" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Memora - Undangan Digital & Buku Tamu Eksklusif (FKStudio)</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Swiper & Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Montserrat:wght@100;300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @PwaHead

    <style>
        :root {
            --memora-bg: #FDFCFB;
            --memora-text: #0F172A;
            --memora-gold: #C5A267;
            --nav-bg: rgba(253, 252, 251, 0.85);
            --hero-overlay: rgba(253, 252, 251, 0.55);
        }

        .dark {
            --memora-bg: #0F172A;
            --memora-text: #F8FAFC;
            --memora-gold: #C5A267;
            --nav-bg: rgba(15, 23, 42, 0.88);
            --hero-overlay: rgba(15, 23, 42, 0.75);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--memora-bg);
            color: var(--memora-text);
            overflow-x: hidden;
            transition: background-color 0.8s ease;
        }

        .hero-section {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 5rem;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .hero-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 5;
            background: var(--hero-overlay);
            transition: background 0.8s ease;
        }

        .hero-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            px: 2rem;
            position: relative;
            z-index: 10;
            padding: 2rem;
        }

        .hero-slider {
            width: 100%;
            height: 100%;
        }

        .hero-slide {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .glass-nav {
            background: var(--nav-bg);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.6s ease;
        }

        .elite-btn {
            padding: 0.8rem 2.2rem;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5em;
            border-radius: 9999px;
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--memora-gold);
        }

        .elite-btn-solid {
            background-color: var(--memora-gold);
            color: var(--memora-bg);
        }

        .elite-btn-solid:hover {
            background-color: var(--memora-text);
            border-color: var(--memora-text);
            transform: translateY(-5px);
        }

        .elite-btn-outline {
            background-color: transparent;
            color: var(--memora-text);
            border: 1px solid rgba(197, 162, 103, 0.4);
        }

        .elite-btn-outline:hover {
            border-color: var(--memora-gold);
            transform: translateY(-5px);
        }

        .font-serif {
            font-family: 'Cormorant Garamond', serif;
        }

        .shimmer-text {
            background: linear-gradient(90deg, var(--memora-text), var(--memora-gold), var(--memora-text));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textShimmer 5s linear infinite;
        }

        @keyframes textShimmer {
            to {
                background-position: 200% center;
            }
        }

        .toggle-btn {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--memora-gold);
            background: var(--memora-bg);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="antialiased selection:bg-memora-gold selection:text-white overflow-x-hidden"
    :class="{ 'overflow-hidden': mobileMenu }">

    @php
        $sliders = \App\Models\LandingSlider::where('is_active', true)->orderBy('sort_order')->get();
        if ($sliders->isEmpty()) {
            $sliders = collect([
                (object) ['image_path' => 'images/hero-bg.png'],
                (object) ['image_path' => 'images/slider-2-sage.png'],
                (object) ['image_path' => 'images/slider-3-royal.png'],
            ]);
        }
    @endphp

    <!-- 💍 Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-[300] h-20 md:h-24 glass-nav flex justify-between items-center px-6 md:px-20 transition-all duration-700"
        :class="{ 'py-3': scrolled || mobileMenu }">
        <a href="/" class="flex items-center gap-4 group">
            <div class="hover:rotate-[180deg] transition-transform duration-1000">
                <span class="font-serif text-2xl font-black italic text-memora-gold">M.</span>
            </div>
            <div class="hidden sm:block">
                <span
                    class="text-lg md:text-xl font-serif font-black tracking-widest uppercase leading-none block">Memora</span>
                <p class="text-[7px] font-black tracking-[0.4em] text-gold uppercase mt-1">by FKStudio</p>
            </div>
        </a>

        <div class="flex items-center gap-4">
            <button @click="darkMode = !darkMode" class="flex text-sm opacity-90 hover:opacity-100 transition">
                <i class="fas" :class="darkMode ? 'fa-sun' : 'fa-moon'"></i>
            </button>
            @auth
                <a href="{{ route('dashboard') }}" class="elite-btn elite-btn-solid !px-6 !py-3">Dashboard</a>
            @else
                <a href="{{ route('login') }}"
                    class="hidden md:block text-[9px] font-black uppercase tracking-[0.4em] text-main opacity-90 hover:opacity-100 transition">Masuk</a>
                <a href="{{ route('register') }}"
                    class="hidden lg:block elite-btn elite-btn-solid !px-6 !py-3">Bergabung</a>
            @endauth
            <button @click="mobileMenu = !mobileMenu" class="toggle-btn flex lg:hidden relative z-[400]">
                <i class="fas" :class="mobileMenu ? 'fa-times' : 'fa-bars'"></i>
            </button>
        </div>
    </nav>

    <!-- 🎪 High-Stability Pro Hero Master -->
    <header class="hero-section">
        <!-- 🎬 Background Layer -->
        <div class="hero-bg">
            <div class="hero-slider swiper swiper-hero">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $slider)
                        <div class="swiper-slide hero-slide"
                            style="background-image: url('{{ asset($slider->image_path) }}')"></div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 📝 Content Wording -->
        <div class="hero-container">
            <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
                <div
                    class="inline-flex items-center gap-4 py-2 px-6 mb-8 rounded-full border border-gold/10 bg-gold/5 text-[9px] font-black uppercase tracking-[0.8em] text-gold mx-auto">
                    <span class="h-1 w-1 rounded-full bg-gold animate-ping"></span>
                    Memora by FKStudio
                </div>

                <h1 class="font-serif text-5xl md:text-8xl font-black leading-tight tracking-tighter mb-10 text-main">
                    Setiap Janji adalah <span class="italic shimmer-text font-medium">Abadi,</span> <br>
                    Setiap Momen <span class="shimmer-text italic">Layak Dikenang.</span>
                </h1>

                <p
                    class="max-w-xl mx-auto text-muted text-base md:text-xl font-light italic leading-loose mb-14 opacity-80">
                    Dari undangan hingga jejak kehadiran, <span class="text-main font-bold">Memora</span> merangkai
                    kenangan dalam pengalaman digital yang indah dan bermakna.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-8">
                    <a href="{{ route('packages.index') }}"
                        class="elite-btn elite-btn-solid !px-12 !py-6 w-full sm:w-auto">Buat Undangan</a>
                    <a href="{{ route('themes.index') }}"
                        class="group flex items-center gap-5 elite-btn elite-btn-outline !px-10 !py-6 w-full sm:w-auto">
                        Lihat Tema
                        {{-- <div class="w-6 h-[1px] bg-gold group-hover:w-12 transition-all duration-700"></div> --}}
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- 📱 Mobile Menu Dropdown -->
    <div x-show="mobileMenu" x-transition x-cloak
        class="fixed inset-0 z-[250] bg-var(--memora-bg) flex flex-col pt-32 px-10"
        style="background: var(--memora-bg)">
        <div class="space-y-10">
            <a @click="mobileMenu = false" href="#features" class="block font-serif text-[3.5rem] italic text-main">The
                Craft</a>
            <a @click="mobileMenu = false" href="{{ route('themes.index') }}"
                class="block font-serif text-[3.5rem] italic text-main">Gallery</a>
            <a @click="mobileMenu = false" href="{{ route('packages.index') }}"
                class="block font-serif text-[3.5rem] italic text-gold">Packages</a>
        </div>
        <div class="mt-auto pb-16">
            <a href="{{ route('register') }}" class="elite-btn elite-btn-solid w-full py-6">Apply Now</a>
        </div>
    </div>

    <!-- 🏺 Specialized Services -->
    <section id="features" class="py-32 relative overflow-hidden bg-transparent z-10 border-t border-white/5">
        <div class="max-w-6xl mx-auto px-10 relative z-10">
            <div class="max-w-3xl mb-24 text-center md:text-left" data-aos="fade-up">
                <span class="text-gold font-black uppercase tracking-[1em] text-[10px] block mb-6">Expertise</span>
                <h2 class="font-serif text-5xl md:text-7xl font-black leading-none text-main uppercase">Layanan <br>
                    <span class="italic opacity-10">Paling Sakral.</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                <div class="flex flex-col text-center md:text-left" data-aos="fade-up">
                    <div
                        class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-gold text-xl mb-10 border border-white/10 mx-auto md:mx-0">
                        <i class="fas fa-magic"></i>
                    </div>
                    <h3 class="font-serif text-3xl mb-6 text-main">Digital Invitation</h3>
                    <p class="text-muted text-sm leading-loose font-medium italic opacity-60">Visual artisan kelas dunia
                        untuk menyebarkan kabar bahagia dengan kemewahan mutlak.</p>
                </div>
                <div class="flex flex-col text-center md:text-left" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-gold text-xl mb-10 border border-white/10 mx-auto md:mx-0">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h3 class="font-serif text-3xl mb-6 text-main">Smart Guest Book</h3>
                    <p class="text-muted text-sm leading-loose font-medium italic opacity-60">Manajemen tamu digital
                        terintegrasi yang memastikan resepsi Anda berlangsung sempurna.</p>
                </div>
                <div class="flex flex-col text-center md:text-left" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-gold text-xl mb-10 border border-white/10 mx-auto md:mx-0">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h3 class="font-serif text-3xl mb-6 text-main">Elite RSVP</h3>
                    <p class="text-muted text-sm leading-loose font-medium italic opacity-60">Sistem reservasi
                        intelijen yang memberikan kepastian jumlah tamu dengan presisi tinggi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 🏺 Themes Gallery (Refined Layout) -->
    <section class="py-48 relative z-10">
        <div class="max-w-6xl mx-auto px-10">
            <div class="flex flex-col lg:flex-row justify-between items-end mb-32 gap-12 text-center lg:text-left"
                data-aos="fade-up">
                <div class="max-w-3xl">
                    <span class="text-gold font-black uppercase tracking-[1em] text-[11px] block mb-8">The
                        Collection</span>
                    <h2
                        class="font-serif text-5xl md:text-8xl font-black text-main leading-none uppercase tracking-tighter">
                        Mahakarya.</h2>
                </div>
                <a href="{{ route('themes.index') }}"
                    class="elite-btn elite-btn-solid !px-12 !py-5 mx-auto lg:mx-0">Explore Hall</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <div class="group relative aspect-[4/5] rounded-[2rem] overflow-hidden" data-aos="zoom-in">
                    <div
                        class="absolute inset-0 bg-slate-950 flex flex-col items-center justify-center p-12 text-center group-hover:scale-105 transition duration-1000">
                        <h4 class="font-serif text-4xl md:text-6xl italic text-gold mb-8">Serenity</h4>
                        <p class="text-[9px] font-black uppercase tracking-[0.8em] text-white opacity-20">Noir Studio
                        </p>
                    </div>
                </div>
                <div class="group relative aspect-[4/5] rounded-[2rem] overflow-hidden" data-aos="zoom-in"
                    data-aos-delay="200">
                    <div
                        class="absolute inset-0 bg-[#FDFCFB] flex flex-col items-center justify-center p-12 text-center group-hover:scale-105 transition duration-1000">
                        <h4 class="font-serif text-4xl md:text-6xl italic text-black mb-8 font-black uppercase">Sage
                        </h4>
                        <p class="text-[9px] font-black uppercase tracking-[0.8em] text-black opacity-20 italic">FK
                            Botanical</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 🏺 Footer -->
    <footer class="py-32 border-t border-white/5 relative z-10 text-center">
        <div class="max-w-6xl mx-auto px-10">
            <a href="/" class="font-serif text-4xl font-black italic text-memora-gold mb-16 block">M.</a>
            <p class="text-muted text-lg italic leading-loose max-w-2xl mx-auto font-medium opacity-50 mb-16">
                Mengabadikan sakralitas janji suci melalui Kurasi Undangan Digital & Buku Tamu Digital Eksklusif oleh
                FKStudio.</p>

            <div
                class="grid grid-cols-1 md:grid-cols-3 gap-16 mb-24 font-black text-[9px] tracking-[0.6em] uppercase opacity-40">
                <a href="{{ route('themes.index') }}" class="hover:text-gold transition">Gallery</a>
                <a href="{{ route('packages.index') }}" class="hover:text-gold transition">Packages</a>
                <a href="#" class="hover:text-gold transition">Connect</a>
            </div>

            <div class="pt-16 border-t border-white/5">
                <p class="text-white/10 text-[9px] font-black uppercase tracking-[1em] italic">© 2026 Memora by
                    FKStudio.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1600,
            once: true,
            offset: 50,
            easing: 'ease-out-expo'
        });

        const swiperHero = new Swiper('.swiper-hero', {
            loop: true,
            effect: 'fade',
            speed: 3500,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
        });
    </script>
    @RegisterServiceWorkerScript
</body>

</html>
