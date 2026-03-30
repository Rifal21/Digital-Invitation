<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: true, mobileMenu: false, scrolled: false }"
    @scroll.window="scrolled = (window.pageYOffset > 20)" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Investment - Memora by FKStudio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Montserrat:wght@100;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --memora-bg: #FDFCFB;
            --memora-text: #0F172A;
            --memora-gold: #C5A267;
            --nav-bg: rgba(253, 252, 251, 0.85);
            --card-surface: rgba(255, 255, 255, 0.4);
        }

        .dark {
            --memora-bg: #0F172A;
            --memora-text: #F8FAFC;
            --memora-gold: #C5A267;
            --nav-bg: rgba(15, 23, 42, 0.88);
            --card-surface: rgba(30, 41, 59, 0.3);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--memora-bg);
            color: var(--memora-text);
            overflow-x: hidden;
            transition: background-color 1s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .font-serif {
            font-family: 'Cormorant Garamond', serif;
        }

        .glass-nav {
            background: var(--nav-bg);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border-bottom: 1px solid rgba(197, 162, 103, 0.05);
            transition: all 0.8s ease;
        }

        .artisan-card {
            background: var(--card-surface);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            border: 0.5px solid rgba(197, 162, 103, 0.15);
            border-radius: 3rem;
            transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .artisan-card:hover {
            transform: translateY(-20px);
            border-color: rgba(197, 162, 103, 0.5);
            box-shadow: 0 50px 100px -25px rgba(0, 0, 0, 0.1);
            background: rgba(197, 162, 103, 0.02);
        }

        .artisan-card::before {
            content: 'M.';
            position: absolute;
            top: 2rem;
            right: 2.5rem;
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-style: italic;
            font-weight: 700;
            opacity: 0.05;
            transition: opacity 0.8s ease;
        }

        .artisan-card:hover::before {
            opacity: 0.15;
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

        .choice-badge {
            background: linear-gradient(135deg, var(--memora-gold), #e7c68a);
            color: var(--memora-bg);
            padding: 0.5rem 1.8rem;
            border-radius: 9999px;
            font-size: 7px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.5em;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 10px 30px rgba(197, 162, 103, 0.3);
        }

        .shimmer-text {
            background: linear-gradient(90deg, var(--memora-text), var(--memora-gold), var(--memora-text));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textShimmer 6s linear infinite;
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

<body class="antialiased selection:bg-memora-gold selection:text-white" :class="{ 'overflow-hidden': mobileMenu }">

    <!-- 💍 Navigation (Synchronized with Welcome) -->
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

    <!-- 📱 Mobile Menu Dropdown -->
    <div x-show="mobileMenu" x-transition x-cloak
        class="fixed inset-0 z-[250] bg-var(--memora-bg) flex flex-col pt-32 px-10"
        style="background: var(--memora-bg)">
        <div class="space-y-10">
            <a @click="mobileMenu = false" href="/#features" class="block font-serif text-[3.5rem] italic text-main">The
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

    <!-- 🎪 Investment Header -->
    <header class="lg:pt-64 pt-28 lg:pb-32 pb-16 text-center relative">
        <div class="max-w-5xl mx-auto px-10 relative z-10" data-aos="fade-down">
            <span class="text-gold font-black uppercase tracking-[1.5em] text-[10px] block mb-12 opacity-50">Private
                Collection Fees</span>
            <h1 class="font-serif text-6xl md:text-[8rem] font-black leading-[0.9] tracking-tighter mb-12 text-main">
                Investasi <br>
                <span class="italic opacity-10 font-medium">Mahakarya</span> <span class="shimmer-text italic">Janji
                    Suci.</span>
            </h1>
            <p class="max-w-2xl mx-auto text-muted text-sm md:text-lg font-light italic leading-loose opacity-60">
                Pilih kurasi layanan terbaik untuk mengabadikan sakralitas momen Anda dalam kemewahan digital murni.
            </p>
        </div>
    </header>

    <!-- 🏺 Artisan Pricing Grid -->
    <section class="pb-64 relative">
        <div class="max-w-7xl mx-auto px-8 md:px-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 md:gap-20">
                @foreach ($packages as $package)
                    <div class="artisan-card flex flex-col items-center text-center group" data-aos="fade-up"
                        data-aos-delay="{{ $loop->index * 120 }}">
                        @if ($loop->iteration == 2)
                            <div class="choice-badge">Elite Excellence</div>
                        @endif

                        <span
                            class="text-gold font-black uppercase tracking-[1.2em] text-[8px] block mb-12 opacity-50 group-hover:opacity-100 transition-opacity duration-1000">{{ $package->name }}</span>

                        <div class="mb-14 flex items-baseline justify-center gap-3">
                            <span class="text-sm font-serif opacity-20 italic">IDR</span>
                            <span
                                class="font-serif text-6xl md:text-9xl font-black text-main tracking-tighter">{{ number_format($package->price / 1000, 0) }}<span
                                    class="text-3xl italic opacity-5">k</span></span>
                        </div>

                        <div
                            class="w-20 h-[0.5px] bg-gold opacity-10 mb-14 group-hover:w-32 transition-all duration-1000">
                        </div>

                        <ul
                            class="w-full space-y-4 mb-10 text-[13px] font-medium tracking-[0.1em] text-muted opacity-80 flex-grow group-hover:opacity-100 transition-opacity duration-1000 leading-normal">
                            @foreach (collect($package->features)->take(5) as $feature)
                                <li class="flex items-center justify-center gap-3">
                                    <div class="w-1 h-1 rounded-full bg-gold opacity-50"></div>
                                    <span class="first-letter:uppercase">{{ strtolower($feature) }}</span>
                                </li>
                            @endforeach
                        </ul>

                        @php
                            $checkoutUrl = route('packages.checkout', [
                                'package' => $package->id,
                                'invitation' => request()->invitation ?? Auth::id(),
                            ]);
                            // Wait, the route requires invitation ID. If not present, we might need to handle it.
                            // Actually, I'll update the route to be optional or just handle it here.
                        @endphp
                        @auth
                            @if (request()->invitation)
                                <a href="{{ route('packages.checkout', ['package' => $package->id, 'invitation' => request()->invitation]) }}"
                                    class="elite-btn elite-btn-solid w-full !py-7 !text-[11px]">Ambil Mahakarya</a>
                            @else
                                <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-4 opacity-40">
                                    Pilih dari Dashboard</p>
                                <a href="{{ route('dashboard') }}"
                                    class="elite-btn w-full !py-7 !text-[11px] opacity-40">Kembali</a>
                            @endif
                        @else
                            <a href="{{ route('register') }}"
                                class="elite-btn elite-btn-solid w-full !py-7 !text-[11px]">Mulai Buat Undangan</a>
                        @endauth
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 🏺 Aesthetic Footer -->
    <footer class="py-48 border-t border-white/5 text-center relative">
        <div class="max-w-6xl mx-auto px-10">
            <div
                class="w-16 h-16 bg-gold/5 border border-gold/10 rounded-[2.5rem] flex items-center justify-center mx-auto mb-16 shadow-2xl transition hover:rotate-45">
                <span class="font-serif text-3xl font-black italic text-memora-gold">M</span>
            </div>
            <p class="text-muted text-lg italic leading-loose max-w-xl mx-auto font-medium opacity-30 mb-20">© 2026
                Memora by FKStudio. Defined by Excellence.</p>
            <div class="w-40 h-[0.5px] bg-gold opacity-10 mx-auto"></div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1800,
            once: true,
            offset: 50,
            easing: 'ease-out-expo'
        });
    </script>
</body>

</html>
