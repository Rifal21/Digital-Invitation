<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $invitation->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --sage-green: #3a4d39;
            --sage-mid: #4f6f52;
            --sage-light: #f1f3f0;
            --cream: #f9f8f4;
            --rose-gold: #c5a07c;
            --text-dark: #2c362b;
            --accent-color: {{ $invitation->data['general']['accent_color'] ?? '#3a4d39' }};
        }

        /* Override with dynamic accent */
        .text-sage-green {
            color: var(--accent-color) !important;
        }

        .bg-sage-green {
            background-color: var(--accent-color) !important;
        }

        .border-sage-green {
            border-color: var(--accent-color) !important;
        }

        .bg-sage-light {
            background-color: color-mix(in srgb, var(--accent-color), white 90%) !important;
        }

        [x-cloak] {
            display: none !important;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--cream);
            color: var(--text-dark);
            overflow-x: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        .font-script {
            font-family: 'Alex Brush', cursive;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .font-sans {
            font-family: 'Montserrat', sans-serif;
        }

        .font-pinyon {
            font-family: 'Pinyon Script', cursive;
        }

        .font-cinzel {
            font-family: 'Cinzel', serif;
        }

        .font-cormorant {
            font-family: 'Cormorant Upright', serif;
        }

        .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        .font-greatvibes {
            font-family: 'Great Vibes', cursive;
        }

        .font-mea {
            font-family: 'Mea Culpa', cursive;
        }

        .font-allison {
            font-family: 'Allison', cursive;
        }

        .font-parisienne {
            font-family: 'Parisienne', cursive;
        }

        .font-garamond {
            font-family: 'EB Garamond', serif;
        }

        /* Smooth Reveal Base */
        .reveal-content {
            opacity: 0;
            transform: translateY(30px);
            transition: all 1.2s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .reveal-content.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Glassmorphism */
        .glass-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 10px 30px rgba(58, 77, 57, 0.05);
        }

        /* Gate Styles */
        .gate-container {
            position: relative;
            height: 80vh;
            width: 100%;
            overflow: hidden;
            display: flex;
        }

        .gate-half {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            transition: transform 1.5s cubic-bezier(0.85, 0, 0.15, 1);
        }

        /* Imperial Gate Transitions */
        .imperial-gate-panel {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            background-color: var(--accent-color);
            z-index: 10000;
            transition: all 1.8s cubic-bezier(0.77, 0, 0.175, 1);
        }

        .gate-panel-left {
            clip-path: polygon(0 0, 100% 0, 0 100%, 0 100%);
        }

        .gate-panel-right {
            clip-path: polygon(100% 0, 100% 0, 100% 100%, 0 100%);
        }

        .gate-active .gate-panel-left {
            transform: translate(-105%, -105%);
        }

        .gate-active .gate-panel-right {
            transform: translate(105%, 105%);
        }

        .gate-overlay-content {
            position: fixed;
            inset: 0;
            z-index: 10001;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4vh 0;
            pointer-events: none;
            transition: opacity 0.8s ease;
        }

        .gate-active .gate-overlay-content {
            opacity: 0;
            pointer-events: none;
        }

        .love-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10002;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: none;
            background: transparent;
            outline: none;
        }

        .love-button:hover {
            transform: translate(-50%, -50%) scale(1.2);
        }

        .love-button i {
            font-size: 5rem;
            filter: drop-shadow(0 0 20px rgba(255, 77, 109, 0.8));
            color: #ff4d6d;
        }

        .love-button span {
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.3em;
            color: white;
            margin-top: 10px;
            opacity: 0.8;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .love-button-pulse {
            animation: imperialHeart 2.5s infinite ease-in-out;
        }

        @keyframes imperialHeart {
            0% {
                transform: translate(-50%, -50%) scale(1);
                filter: drop-shadow(0 0 10px rgba(255, 77, 109, 0.4));
            }

            50% {
                transform: translate(-50%, -50%) scale(1.15);
                filter: drop-shadow(0 0 30px rgba(255, 77, 109, 0.9));
            }

            100% {
                transform: translate(-50%, -50%) scale(1);
                filter: drop-shadow(0 0 10px rgba(255, 77, 109, 0.4));
            }
        }

        .imperial-reveal {
            animation: imperialReveal 1.2s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        @keyframes imperialReveal {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .floating-heart {
            position: fixed;
            pointer-events: none;
            z-index: 1000;
            user-select: none;
            animation: fall linear forwards;
        }

        @keyframes fall {
            0% {
                transform: translateY(-10vh) translateX(0) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(110vh) translateX(20px) rotate(360deg);
                opacity: 0;
            }
        }

        .polaroid-frame {
            background: white;
            padding: 10px 10px 35px 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transform: rotate(-1deg);
            transition: all 0.5s ease;
        }

        .polaroid-frame:nth-child(even) { transform: rotate(1.5deg); }
        .polaroid-frame:hover { transform: rotate(0deg) scale(1.05); z-index: 10; }

        .gallery-carousel {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            gap: 20px;
            padding: 20px 0;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .gallery-carousel::-webkit-scrollbar { display: none; }
        .gallery-carousel div { flex: 0 0 80%; scroll-snap-align: center; }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 3.5rem !important;
            }

            .gate-container {
                height: 60vh;
            }
        }
    </style>
</head>

<body class="antialiased" x-data="themePreview()" x-init="init()">

    <!-- Imperial Gate Cinematic Opening -->
    <div id="imperial-gate" :class="isOpen ? 'gate-active' : ''" x-show="!isFullyOpened"
        x-transition:leave="transition ease-in duration-500" x-data="{ isFullyOpened: false }">
        <!-- The Left Diagonal Panel -->
        <div class="imperial-gate-panel gate-panel-left"></div>

        <!-- The Right Diagonal Panel -->
        <div class="imperial-gate-panel gate-panel-right"></div>

        <!-- Overlay Floating Content -->
        <div class="gate-overlay-content">
            <div class="text-center text-white space-y-4 px-6 imperial-reveal mb-12">
                <span class="text-[10px] uppercase tracking-[0.8em] opacity-60">Exclusive Wedding Invitation</span>
                <div class="h-px w-20 bg-white/20 mx-auto"></div>
            </div>

            <div class="text-center text-white px-6 w-full max-w-6xl imperial-reveal" style="animation-delay: 0.3s">
                <div class="flex flex-col md:flex-row items-center justify-center gap-2 md:gap-20">
                    <div class="space-y-1">
                        <h1 :class="data.data?.general?.title_font ?? 'font-script'" class="text-2xl md:text-5xl text-white drop-shadow-lg" x-text="data.groom_name"></h1>
                        <p x-show="data.data?.groom?.full_name" class="text-[7px] md:text-[8px] uppercase tracking-[0.4em] opacity-60" x-text="data.data?.groom?.full_name"></p>
                    </div>

                    <!-- Centered Buffer for the pulsing Heart -->
                    <div class="h-48 md:h-auto md:w-32 shrink-0"></div>

                    <div class="space-y-1">
                        <h1 :class="data.data?.general?.title_font ?? 'font-script'" class="text-2xl md:text-5xl text-white drop-shadow-lg" x-text="data.bride_name"></h1>
                        <p x-show="data.data?.bride?.full_name" class="text-[7px] md:text-[8px] uppercase tracking-[0.4em] opacity-60" x-text="data.data?.bride?.full_name"></p>
                    </div>
                </div>
            </div>

            <div class="text-center text-white px-6 mt-12 imperial-reveal" style="animation-delay: 0.5s">
                <p class="font-serif italic text-lg opacity-60" x-text="'Untuk ' + toName"></p>
            </div>
        </div>

        {{-- <div class="pb-8">
            <!-- Spacing for the fixed middle button -->
        </div> --}}
    </div>

    <!-- The Central Heart Trigger (Fixed over everything) -->
    <button @click="openInvitation(); setTimeout(() => isFullyOpened = true, 2000)"
        class="love-button love-button-pulse" :class="isOpen ? 'opacity-0 scale-50' : ''">
        <i class="fas fa-heart"></i>
        <span>Klik Buka</span>
    </button>
    </div>

    <!-- Main Content -->
    <div id="main" x-show="isOpen" x-cloak class="relative">

        <!-- Sticky Crystal Navigation -->
        <div class="fixed bottom-6 left-1/2 -translate-x-1/2 w-full max-w-[320px] z-[100] px-4">
            <nav
                class="bg-white/70 backdrop-blur-2xl border border-white/40 p-2 rounded-full flex justify-between items-center shadow-[0_20px_50px_rgba(0,0,0,0.15)]">
                <a href="#home"
                    class="w-12 h-12 flex items-center justify-center rounded-full text-sage-green/60 hover:text-sage-green hover:bg-sage-green/5 transition-all"><i
                        class="fas fa-home text-sm"></i></a>
                <a href="#groom"
                    class="w-12 h-12 flex items-center justify-center rounded-full text-sage-green/60 hover:text-sage-green hover:bg-sage-green/5 transition-all"><i
                        class="fas fa-male text-sm"></i></a>
                <a href="#bride"
                    class="w-12 h-12 flex items-center justify-center rounded-full text-sage-green/60 hover:text-sage-green hover:bg-sage-green/5 transition-all"><i
                        class="fas fa-female text-sm"></i></a>
                <a href="#event"
                    class="w-12 h-12 flex items-center justify-center rounded-full text-sage-green/60 hover:text-sage-green hover:bg-sage-green/5 transition-all"><i
                        class="fas fa-calendar-alt text-sm"></i></a>
                <a href="#gallery"
                    class="w-12 h-12 flex items-center justify-center rounded-full text-sage-green/60 hover:text-sage-green hover:bg-sage-green/5 transition-all"><i
                        class="fas fa-images text-sm"></i></a>
                <a href="#gift"
                    class="w-12 h-12 flex items-center justify-center rounded-full text-sage-green/60 hover:text-sage-green hover:bg-sage-green/5 transition-all"><i
                        class="fas fa-gift text-sm"></i></a>
                <a href="#rsvp"
                    class="w-12 h-12 flex items-center justify-center rounded-full text-sage-green/60 hover:text-sage-green hover:bg-sage-green/5 transition-all"><i
                        class="fas fa-comment text-sm"></i></a>
            </nav>
        </div>

        <!-- Hero Section -->
        <section id="home"
            class="min-h-screen relative flex items-center justify-center bg-cream overflow-hidden px-6">
            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000"
                :style="'background-image: url(' + (data.data?.hero?.background_image || '') + '); opacity: ' + (data.data?.hero
                    ?.background_image ? '0.2' : '0')">
            </div>
            <div
                class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/natural-paper.png')]">
            </div>

            <div class="text-center z-10" data-aos="zoom-out">
                <div class="mb-10 opacity-30 tracking-[1em] text-[10px] font-black uppercase">The Wedding Of</div>
                <div class="space-y-4 mb-14">
                    <div class="space-y-2">
                        <h2 :class="data.data?.hero?.title_font ?? 'font-script'" class="text-7xl md:text-[10rem] text-sage-green leading-none hero-title" x-text="data.groom_name || ''"></h2>
                        <p x-show="data.data?.groom?.full_name" class="text-[10px] md:text-xs font-black text-sage-green/30 uppercase tracking-[0.5em]" x-text="data.data?.groom?.full_name"></p>
                    </div>

                    <div class="text-4xl text-rose-gold opacity-40 font-script">&</div>

                    <div class="space-y-2">
                        <h2 :class="data.data?.hero?.title_font ?? 'font-script'" class="text-7xl md:text-[10rem] text-sage-green leading-none hero-title" x-text="data.bride_name || ''"></h2>
                        <p x-show="data.data?.bride?.full_name" class="text-[10px] md:text-xs font-black text-sage-green/30 uppercase tracking-[0.5em]" x-text="data.data?.bride?.full_name"></p>
                    </div>
                </div>
                <div class="flex items-center justify-center gap-6">
                    <div class="h-px w-16 bg-sage-green/20"></div>
                    <p class="font-serif text-2xl md:text-3xl italic text-sage-green"
                        x-text="formatDate(data.event_date || '')"></p>
                    <div class="h-px w-16 bg-sage-green/20"></div>
                </div>
            </div>

            <div class="absolute bottom-24 animate-bounce text-sage-green opacity-20">
                <i class="fas fa-chevron-down"></i>
            </div>
        </section>

        <!-- Groom Section -->
        <section id="groom"
            class="min-h-screen relative flex flex-col md:flex-row items-center bg-white overflow-hidden">
            <div class="w-full md:w-1/2 h-[60vh] md:h-screen relative overflow-hidden" data-aos="fade-right">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 hover:scale-110"
                    :style="'background-image: url(' + (data.data?.groom?.image ||
                        'https://images.unsplash.com/photo-1550005810-350771a3f033') + '); background-position: ' + (
                        data.data?.groom?.bg_pos || 'center')">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent md:hidden">
                </div>
            </div>
            <div class="w-full md:w-1/2 p-12 md:p-24 text-center md:text-left" data-aos="fade-up">
                <span class="text-rose-gold font-script text-5xl mb-6 block">The Groom</span>
                <h2 :class="data.data?.general?.title_font ?? 'font-script'"
                    class="text-6xl md:text-9xl text-sage-green mb-2" x-text="data.groom_name"></h2>
                <h3 x-show="data.data?.groom?.full_name"
                    class="text-xs md:text-lg font-bold text-sage-green/60 uppercase tracking-[0.4em] mb-8"
                    x-text="data.data?.groom?.full_name"></h3>
                <div class="h-px w-20 bg-sage-green/10 mb-8 mx-auto md:mx-0"></div>
                <div class="space-y-4">
                    <p class="text-[10px] font-black uppercase tracking-[0.4em] text-sage-green/40"
                        x-text="data.data?.groom?.child_order || ''"></p>
                    <div class="space-y-1">
                        <p class="text-[8px] font-black uppercase tracking-widest text-rose-gold">Putra Dari</p>
                        <p class="text-xl font-bold text-sage-green leading-tight"
                            x-text="(data.data?.groom?.father || '') + ' & ' + (data.data?.groom?.mother || '')"></p>
                    </div>
                    <template x-if="data.data?.groom?.instagram">
                        <a :href="'https://instagram.com/' + data.data?.groom?.instagram.replace('@', '')"
                            target="_blank"
                            class="inline-flex items-center gap-2 text-sage-green/60 hover:text-sage-green transition pt-4">
                            <i class="fab fa-instagram"></i>
                            <span class="text-xs font-bold" x-text="data.data?.groom?.instagram"></span>
                        </a>
                    </template>
                </div>
            </div>
        </section>

        <!-- Bride Section -->
        <section id="bride"
            class="min-h-screen relative flex flex-col md:flex-row-reverse items-center bg-cream overflow-hidden">
            <div class="w-full md:w-1/2 h-[60vh] md:h-screen relative overflow-hidden" data-aos="fade-left">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 hover:scale-110"
                    :style="'background-image: url(' + (data.data?.bride?.image ||
                        'https://images.unsplash.com/photo-1544005313-94ddf0286df2') + '); background-position: ' + (
                        data.data?.bride?.bg_pos || 'center')">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent md:hidden">
                </div>
            </div>
            <div class="w-full md:w-1/2 p-12 md:p-24 text-center md:text-right" data-aos="fade-up">
                <span class="text-rose-gold font-script text-5xl mb-6 block">The Bride</span>
                <h2 :class="data.data?.general?.title_font ?? 'font-script'"
                    class="text-6xl md:text-9xl text-sage-green mb-2" x-text="data.bride_name"></h2>
                <h3 x-show="data.data?.bride?.full_name"
                    class="text-xs md:text-lg font-bold text-sage-green/60 uppercase tracking-[0.4em] mb-8"
                    x-text="data.data?.bride?.full_name"></h3>
                <div class="h-px w-20 bg-sage-green/10 mb-8 mx-auto md:ml-auto md:mr-0"></div>
                <div class="space-y-4">
                    <p class="text-[10px] font-black uppercase tracking-[0.4em] text-sage-green/40"
                        x-text="data.data?.bride?.child_order || ''"></p>
                    <div class="space-y-1">
                        <p class="text-[8px] font-black uppercase tracking-widest text-rose-gold">Putri Dari</p>
                        <p class="text-xl font-bold text-sage-green leading-tight"
                            x-text="(data.data?.bride?.father || '') + ' & ' + (data.data?.bride?.mother || '')"></p>
                    </div>
                    <template x-if="data.data?.bride?.instagram">
                        <a :href="'https://instagram.com/' + data.data?.bride?.instagram.replace('@', '')"
                            target="_blank"
                            class="inline-flex items-center gap-2 text-sage-green/60 hover:text-sage-green transition pt-4">
                            <i class="fab fa-instagram"></i>
                            <span class="text-xs font-bold" x-text="data.data?.bride?.instagram"></span>
                        </a>
                    </template>
                </div>
            </div>
        </section>

        <!-- Event Section -->
        <section id="event" class="py-32 bg-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-5"
                style="background-image: url('https://www.transparenttextures.com/patterns/natural-paper.png')"></div>
            <div class="max-w-4xl mx-auto px-6">
                <div class="text-center mb-24" data-aos="fade-up">
                    <h2 class="font-script text-7xl text-sage-green mb-4">Waktu & Tempat</h2>
                    <div class="h-px w-24 bg-rose-gold/30 mx-auto"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Akad Card -->
                    <div class="glass-card p-12 rounded-[3.5rem] border-white/60 shadow-xl" data-aos="fade-right">
                        <div class="text-center space-y-8">
                            <span class="text-[10px] font-black uppercase tracking-[0.6em] text-rose-gold">Akad
                                Nikah</span>
                            <div class="space-y-4">
                                <p class="text-4xl font-black text-sage-green font-serif"
                                    x-text="formatDateFull(data.event_date)"></p>
                                <p class="text-sm font-bold text-sage-green/60"
                                    x-text="(data.data?.event?.akad_time || '') + ' WIB — SELESAI'"></p>
                            </div>
                            <div class="h-px w-12 bg-sage-green/10 mx-auto"></div>
                            <p class="font-serif italic text-lg leading-relaxed text-sage-green/80"
                                x-text="data.event_location || ''"></p>
                            <a :href="data.data?.event?.google_maps || '#'" target="_blank"
                                class="inline-block bg-sage-green text-white px-10 py-4 rounded-full text-[10px] font-bold uppercase tracking-widest shadow-lg hover:bg-text-dark transition-all">Lihat
                                Peta</a>
                        </div>
                    </div>

                    <!-- Resepsi Card -->
                    <div class="glass-card p-12 rounded-[3.5rem] border-white/60 shadow-xl" data-aos="fade-left"
                        data-aos-delay="200">
                        <div class="text-center space-y-8">
                            <span
                                class="text-[10px] font-black uppercase tracking-[0.6em] text-rose-gold">Resepsi</span>
                            <div class="space-y-4">
                                <p class="text-4xl font-black text-sage-green font-serif"
                                    x-text="formatDateFull(data.event_date)"></p>
                                <p class="text-sm font-bold text-sage-green/60"
                                    x-text="(data.data?.event?.resepsi_time || '') + ' WIB — SELESAI'"></p>
                            </div>
                            <div class="h-px w-12 bg-sage-green/10 mx-auto"></div>
                            <p class="font-serif italic text-lg leading-relaxed text-sage-green/80"
                                x-text="data.event_location || ''"></p>
                            <a :href="data.data?.event?.google_maps || '#'" target="_blank"
                                class="inline-block border-2 border-sage-green text-sage-green px-10 py-4 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-sage-green hover:text-white transition-all">Navigasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Story -->
        <section id="story" class="py-32 bg-cream relative overflow-hidden"
            x-show="data.data?.general?.show_story">
            <div class="max-w-2xl mx-auto px-6">
                <div class="text-center mb-24" data-aos="fade-up">
                    <h2 class="font-script text-8xl text-sage-green mb-4">Journey of Love</h2>
                    <p class="font-serif italic text-lg opacity-40">Kisah perjalanan cinta kami</p>
                </div>

                <div class="space-y-16 relative">
                    <div class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-[1px] bg-sage-green/10"></div>
                    <template x-for="(item, index) in (data.data?.story || [])">
                        <div class="relative flex flex-col items-center" data-aos="fade-up">
                            <div
                                class="w-10 h-10 bg-white rounded-full border-2 border-rose-gold z-10 flex items-center justify-center mb-8 shadow-lg">
                                <i class="fas fa-heart text-rose-gold text-[10px]"></i>
                            </div>
                            <div
                                class="glass-card p-10 rounded-[2rem] text-center w-full shadow-lg transition-transform hover:-translate-y-2">
                                <span class="font-serif italic text-3xl text-rose-gold/60 mb-4 block"
                                    x-text="item.year"></span>
                                <h4 class="text-sm font-black text-sage-green uppercase tracking-[0.2em] leading-relaxed"
                                    x-text="item.content"></h4>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <!-- Photo Gallery -->
        <section id="gallery" class="py-32 bg-white relative overflow-hidden"
            x-show="data.data?.general?.show_gallery">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center mb-24" data-aos="fade-up">
                    <h2 class="font-script text-8xl text-sage-green mb-4">The Gallery</h2>
                <div class="h-px w-24 bg-rose-gold/30 mx-auto"></div>
                </div>

                <!-- Masonry Layout -->
                <div x-show="!data.data?.gallery_style || data.data?.gallery_style === 'masonry'" 
                     class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
                    <template x-for="(img, index) in (data.data?.gallery || [])">
                        <div class="break-inside-avoid" data-aos="zoom-in">
                            <img :src="img" class="w-full rounded-[2rem] shadow-2xl hover:scale-105 transition duration-700">
                        </div>
                    </template>
                </div>

                <!-- Grid Layout -->
                <div x-show="data.data?.gallery_style === 'grid'" 
                     class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="(img, index) in (data.data?.gallery || [])">
                        <div class="aspect-square overflow-hidden rounded-[2rem] shadow-xl" data-aos="zoom-in">
                            <img :src="img" class="w-full h-full object-cover hover:scale-110 transition duration-700">
                        </div>
                    </template>
                </div>

                <!-- Polaroid Layout -->
                <div x-show="data.data?.gallery_style === 'polaroid'" 
                     class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                    <template x-for="(img, index) in (data.data?.gallery || [])">
                        <div class="polaroid-frame" data-aos="zoom-in">
                            <img :src="img" class="w-full aspect-square object-cover mb-2 shadow-inner">
                        </div>
                    </template>
                </div>

                <!-- Carousel Layout -->
                <div x-show="data.data?.gallery_style === 'carousel'" 
                     class="gallery-carousel">
                    <template x-for="(img, index) in (data.data?.gallery || [])">
                        <div class="rounded-[3rem] overflow-hidden shadow-2xl" data-aos="fade-right">
                            <img :src="img" class="w-full h-[60vh] object-cover">
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <!-- Digital Gift -->
        <section id="gift" class="py-32 bg-white relative overflow-hidden"
            x-show="data.data?.general?.show_gift">
            <div class="max-w-xl mx-auto px-6 text-center">
                <div class="mb-20" data-aos="fade-up">
                    <h2 class="font-script text-7xl text-sage-green mb-4">Wedding Gift</h2>
                    <p class="font-serif italic text-sm text-sage-green/60">Doa restu Anda adalah kado terindah bagi
                        kami. Namun jika ingin memberi lebih, dapat melalui:</p>
                </div>

                <div class="space-y-8">
                    <template x-for="(item, index) in (data.data?.gifts || [])" :key="index">
                        <div class="glass-card p-10 rounded-[3.5rem] shadow-2xl space-y-8" data-aos="zoom-in" :data-aos-delay="index * 100">
                            <div class="space-y-2">
                                <p class="text-[10px] font-black uppercase tracking-[0.5em] text-sage-green/40"
                                    x-text="item.bank_name || ''"></p>
                                <h4 class="text-3xl md:text-5xl font-black text-sage-green tracking-widest"
                                    x-text="item.account_number || ''"></h4>
                                <p class="text-xs font-bold uppercase tracking-widest opacity-60"
                                    x-text="'a/n ' + (item.account_holder || '')"></p>
                            </div>
                            <button
                                @click="if(item.account_number) { navigator.clipboard.writeText(item.account_number); alert('Berhasil disalin!'); }"
                                class="bg-sage-green text-white px-10 py-4 rounded-full text-[10px] font-black uppercase tracking-[0.4em] shadow-xl hover:scale-105 transition-all">
                                <i class="fas fa-copy mr-2 opacity-50"></i> Salin No. Rekening
                            </button>
                        </div>
                    </template>
                    
                    <!-- Fallback for legacy (if gifts is somehow empty but gift exists) -->
                    <template x-if="(!data.data?.gifts || data.data?.gifts.length === 0) && data.data?.gift">
                        <div class="glass-card p-12 rounded-[4rem] shadow-2xl space-y-10" data-aos="zoom-in">
                            <div class="space-y-2">
                                <p class="text-[10px] font-black uppercase tracking-[0.5em] text-sage-green/40"
                                    x-text="data.data?.gift?.bank_name || ''"></p>
                                <h4 class="text-3xl md:text-5xl font-black text-sage-green tracking-widest"
                                    x-text="data.data?.gift?.account_number || ''"></h4>
                                <p class="text-xs font-bold uppercase tracking-widest opacity-60"
                                    x-text="'a/n ' + (data.data?.gift?.account_holder || '')"></p>
                            </div>
                            <button
                                @click="if(data.data?.gift?.account_number) { navigator.clipboard.writeText(data.data.gift.account_number); alert('Berhasil disalin!'); }"
                                class="bg-sage-green text-white px-12 py-5 rounded-full text-[10px] font-black uppercase tracking-[0.4em] shadow-xl hover:scale-105 transition-all">
                                Salin No. Rekening
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <!-- RSVP & Guestbook -->
        <section id="rsvp" class="py-32 bg-cream relative overflow-hidden"
            x-show="data.data?.general?.show_rsvp">
            <div class="max-w-4xl mx-auto px-6">
                <div class="text-center mb-24" data-aos="fade-up">
                    <h2 class="font-script text-8xl text-sage-green mb-4">Words of Love</h2>
                    <p class="font-serif italic text-lg opacity-40">Konfirmasi kehadiran & ucapan doa</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                    <!-- RSVP Form -->
                    <div class="glass-card p-10 rounded-[3rem] shadow-xl border-white" data-aos="fade-right">
                        <form @submit.prevent="submitMessage" class="space-y-6">
                            @csrf
                            <div x-show="messageStatus" x-transition class="p-4 rounded-2xl bg-sage-green/10 text-sage-green text-[10px] font-black uppercase tracking-widest text-center" x-text="messageStatus"></div>
                            
                            <div>
                                <label
                                    class="block text-[8px] font-black uppercase tracking-widest text-sage-green/60 mb-3">Nama
                                    Tamu</label>
                                <input type="text" x-model="newMessage.name" required placeholder="Masukkan nama Anda"
                                    class="w-full bg-white/50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-sage-green/20">
                            </div>
                            <div>
                                <label
                                    class="block text-[8px] font-black uppercase tracking-widest text-sage-green/60 mb-3">Kehadiran</label>
                                <select x-model="newMessage.is_attending"
                                    class="w-full bg-white/50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-sage-green/20">
                                    <option value="1">Akan Hadir</option>
                                    <option value="0">Maaf, Tidak Bisa Hadir</option>
                                </select>
                            </div>
                            <div>
                                <label
                                    class="block text-[8px] font-black uppercase tracking-widest text-sage-green/60 mb-3">Pesan
                                    & Doa Restu</label>
                                <textarea x-model="newMessage.message" required rows="4" placeholder="Tulis ucapan doa Anda..."
                                    class="w-full bg-white/50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-sage-green/20"></textarea>
                            </div>
                            <button type="submit" :disabled="isSending"
                                class="w-full bg-sage-green text-white py-5 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl hover:scale-105 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                                <span x-show="!isSending">Kirim Pesan</span>
                                <span x-show="isSending"><i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...</span>
                            </button>
                        </form>
                    </div>

                    <!-- Guestbook Feed -->
                    <div class="space-y-6 max-h-[600px] overflow-y-auto custom-scrollbar pr-4" data-aos="fade-left">
                        <template x-for="msg in messages" :key="msg.id">
                            <div
                                class="glass-card p-8 rounded-[2rem] border-white/40 shadow-sm relative overflow-hidden group">
                                <div class="absolute top-0 right-0 p-4 opacity-10 flex gap-1">
                                    <i class="fas fa-heart text-sage-green"></i>
                                    <i class="fas fa-heart text-sage-green"></i>
                                </div>
                                <div class="flex items-center gap-4 mb-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-sage-green text-white flex items-center justify-center font-bold text-xs" x-text="msg.name.charAt(0)">
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-black text-sage-green uppercase tracking-wider" x-text="msg.name"></h4>
                                        <span class="text-[9px] font-bold text-rose-gold uppercase tracking-widest" x-text="msg.is_attending ? '✓ HADIR' : '✕ TIDAK HADIR'"></span>
                                    </div>
                                </div>
                                <p class="text-xs italic leading-relaxed text-sage-green/70" x-text="'\u0022' + msg.message + '\u0022'"></p>
                                <p class="text-[8px] mt-4 opacity-30 font-black uppercase" x-text="formatTime(msg.created_at)"></p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-32 bg-sage-green text-white text-center">
            <h2 class="font-script text-6xl mb-8">Terima Kasih</h2>
            <p class="font-serif italic text-xl opacity-60 mb-12">Sampai jumpa di hari bahagia kami</p>
            <div class="h-px w-20 bg-white/20 mx-auto mb-12"></div>
            <p class="text-[10px] font-black uppercase tracking-[1em] opacity-40">Created with love by Amora</p>
        </footer>

    </div>

    <!-- Background Music -->
    <template x-if="data.data.general.music_url">
        <iframe id="youtube-player" :src="data.data.general.music_url + '&autoplay=0&enablejsapi=1'" class="hidden"
            frameborder="0"></iframe>
    </template>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        function themePreview() {
            return {
                isOpen: {{ request('preview') ? 'true' : 'false' }},
                isSending: false,
                messageStatus: '',
                messages: @json($messages),
                newMessage: {
                    name: '',
                    message: '',
                    is_attending: 1
                },
                toName: new URLSearchParams(window.location.search).get('to') || 'Tamu Undangan',
                data: {
                    title: @json($invitation->title),
                    groom_name: @json($invitation->groom_name),
                    bride_name: @json($invitation->bride_name),
                    event_date: @json($invitation->event_date),
                    event_location: @json($invitation->event_location),
                    data: @json($invitation->data)
                },
                init() {
                    window.addEventListener('message', (event) => {
                        if (event.data.type === 'UPDATE_DATA') {
                            this.data = event.data.payload;
                            this.$nextTick(() => AOS.refresh());
                        }
                    });
                    if (this.isOpen) {
                        this.startSequence();
                    }
                },
                openInvitation() {
                    this.isOpen = true;
                    this.startSequence();
                    const player = document.getElementById('youtube-player');
                    if (player) player.src = player.src.replace("autoplay=0", "autoplay=1");
                },
                startSequence() {
                    setTimeout(() => {
                        AOS.init({
                            once: true,
                            duration: 1500
                        });
                        this.startHeartSnow();
                    }, 500);
                },
                formatDate(date) {
                    if (!date) return '';
                    const d = new Date(date);
                    return d.getDate().toString().padStart(2, '0') + ' . ' + (d.getMonth() + 1).toString().padStart(2,
                        '0') + ' . ' + d.getFullYear();
                },
                formatDateFull(date) {
                    if (!date) return '';
                    return new Date(date).toLocaleDateString('id-ID', {
                        weekday: 'long',
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    });
                },
                formatTime(date) {
                    const d = new Date(date);
                    return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' }) + ' ' + d.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                },
                async submitMessage() {
                    this.isSending = true;
                    this.messageStatus = '';

                    try {
                        const response = await fetch('{{ route('invitations.message', $invitation->slug) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(this.newMessage)
                        });

                        const result = await response.json();

                        if (result.success) {
                            this.messages.unshift(result.data);
                            this.newMessage = {
                                name: '',
                                message: '',
                                is_attending: 1
                            };
                            this.messageStatus = 'Terima kasih! Pesan Anda telah terkirim.';
                            setTimeout(() => this.messageStatus = '', 5000);
                        }
                    } catch (error) {
                        console.error('Error sending message:', error);
                        this.messageStatus = 'Terjadi kesalahan. Silakan coba lagi.';
                    } finally {
                        this.isSending = false;
                    }
                },
                startHeartSnow() {
                    setInterval(() => {
                        const heart = document.createElement('div');
                        heart.classList.add('floating-heart');
                        heart.innerHTML = '<i class="fas fa-heart text-rose-gold/40"></i>';
                        heart.style.left = Math.random() * 100 + 'vw';
                        heart.style.animationDuration = (Math.random() * 3 + 2) + 's';
                        document.body.appendChild(heart);
                        setTimeout(() => heart.remove(), 5000);
                    }, 1500);
                }
            }
        }
    </script>
</body>

</html>
