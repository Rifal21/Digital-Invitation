<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $invitation->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #ffffff; color: #1e293b; overflow: hidden; -webkit-tap-highlight-color: transparent; }
        .bg-custom { background-color: {{ $invitation->theme_color }}; }
        .text-custom { color: {{ $invitation->theme_color }}; }
        
        #main-content { scroll-behavior: smooth; }

        /* Opening Overlay */
        #opening-overlay {
            position: fixed; inset: 0; z-index: 9999;
            background: #ffffff;
            display: flex; align-items: center; justify-content: center;
            transition: transform 1.2s cubic-bezier(1, 0, 0, 1);
        }

        /* Nav Bottom */
        .nav-bottom {
            position: fixed; bottom: 15px; left: 50%; transform: translateX(-50%);
            background: #000000; border-radius: 100px; padding: 10px 15px;
            display: flex; gap: 5px; box-shadow: 0 10px 40px rgba(0,0,0,0.25); 
            z-index: 1000; width: 90%; max-width: 400px; justify-content: space-around;
        }
        .nav-item { color: #ffffff; font-size: 8px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; opacity: 0.4; transition: 0.3s; flex: 1; text-align: center; }
        .nav-item.active { opacity: 1; text-decoration: underline; text-underline-offset: 4px; }

        /* Diagonal Couple Split */
        .couple-split {
            position: relative;
            height: 90vh;
            width: 100%;
            overflow: hidden;
            display: flex;
            background: #000;
        }
        .couple-half {
            position: absolute;
            inset: 0;
            width: 100%; height: 100%;
            background-size: cover;
            background-position: center;
        }
        .groom-half {
            z-index: 10;
            clip-path: polygon(0 0, 85% 0, 15% 100%, 0 100%);
            border-right: 2px solid white;
        }
        .bride-half {
            z-index: 5;
            clip-path: polygon(85% 0, 100% 0, 100% 100%, 15% 100%);
        }
        .love-center {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            z-index: 20;
            width: 90px; height: 90px;
            background: #000;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 40px rgba(255,255,255,0.2);
            color: #fff;
            font-size: 1.8rem;
            animation: pulse-minimal 2s infinite;
        }

        @keyframes pulse-minimal {
            0% { transform: translate(-50%, -50%) scale(1); box-shadow: 0 0 20px rgba(255,255,255,0.1); }
            50% { transform: translate(-50%, -50%) scale(1.1); box-shadow: 0 0 40px rgba(255,255,255,0.3); }
            100% { transform: translate(-50%, -50%) scale(1); box-shadow: 0 0 20px rgba(255,255,255,0.1); }
        }

        @media (max-width: 640px) {
            .hero-title { font-size: 4rem !important; }
            .section-title { font-size: 2.5rem !important; }
            .couple-split { height: 70vh; }
            .love-center { width: 60px; height: 60px; font-size: 1.2rem; }
        }
    </style>
</head>
<body class="antialiased selection:bg-black selection:text-white" x-data="themePreview()" x-init="init()">

    <!-- Opening Overlay -->
    <div id="opening-overlay" :class="isOpen ? '-translate-y-full opacity-0 pointer-events-none' : ''">
        <div class="text-center px-6">
            <h4 class="text-[10px] font-bold uppercase tracking-[0.5em] text-slate-400 mb-6 font-bold tracking-[0.5em]">Exclusive Invitation</h4>
            <h1 class="text-5xl md:text-8xl font-extrabold tracking-tighter mb-12" x-text="data.groom_name + ' & ' + data.bride_name">
                {{ $invitation->groom_name }} & {{ $invitation->bride_name }}
            </h1>
            <div class="mb-12">
                 <p class="text-xs text-slate-500 font-medium italic mb-2 tracking-widest uppercase opacity-40">Dear honored guest:</p>
                 <span class="text-black font-extrabold text-xl md:text-2xl uppercase border-b-2 border-black/10">{{ request('to', 'Tamu Undangan') }}</span>
            </div>
            <button @click="openInvitation()" class="px-10 py-4 bg-black text-white text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-slate-800 transition shadow-xl">
                Enter Invitation
            </button>
        </div>
    </div>

    <div id="main-content" class="h-screen overflow-y-auto" :class="!isOpen ? 'hidden' : ''">
        
        <!-- Hero -->
        <section id="home" class="min-h-screen flex items-center justify-center p-6 bg-slate-50 relative overflow-hidden text-center">
            <div class="z-10" data-aos="zoom-in" data-aos-duration="1200">
                <h2 class="text-6xl md:text-[10rem] font-extrabold tracking-tighter leading-none mb-10 hero-title">
                    <span x-text="data.groom_name">{{ $invitation->groom_name }}</span> <br class="md:hidden"> <span class="text-custom">&</span> <br class="md:hidden"> <span x-text="data.bride_name">{{ $invitation->bride_name }}</span>
                </h2>
                <div class="h-1 w-20 bg-black mx-auto mb-10 opacity-10"></div>
                <p class="text-lg md:text-xl font-bold uppercase tracking-[0.4em]" x-text="formatDate(data.event_date)">{{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d . m . Y') }}</p>
            </div>
        </section>

        <!-- Couple Section -->
        <section id="couple" class="bg-white overflow-hidden">
            <div class="py-20 md:py-32 px-6 text-center" data-aos="fade-up">
                 <h2 class="text-4xl md:text-5xl font-extrabold tracking-tighter mb-4 section-title">THE PAIR</h2>
                 <p class="text-[10px] uppercase font-bold tracking-widest opacity-30 italic" x-text="data.data.general.quote">Pure commitment in black & white</p>
            </div>

            <div class="couple-split" data-aos="fade-up">
                 <div class="couple-half groom-half grayscale brightness-75 hover:grayscale-0 hover:brightness-100 transition duration-1000" style="background-image: url('https://images.unsplash.com/photo-1550005810-350771a3f033?auto=format&fit=crop&w=1200&q=80')">
                    <div class="absolute bottom-10 left-10 md:bottom-20 md:left-20 z-30">
                        <h3 class="text-4xl md:text-8xl font-black text-white tracking-tighter uppercase" x-text="data.groom_name">{{ $invitation->groom_name }}</h3>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-white/50 mt-2" x-text="'Son of ' + (data.data.groom.father || 'Parents')">Son of Mr. & Mrs.</p>
                    </div>
                 </div>

                 <div class="couple-half bride-half grayscale brightness-75 hover:grayscale-0 hover:brightness-100 transition duration-1000" style="background-image: url('https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=1200&q=80')">
                    <div class="absolute top-10 right-10 md:top-20 md:right-20 z-30 text-right">
                        <h3 class="text-4xl md:text-8xl font-black text-white tracking-tighter uppercase" x-text="data.bride_name">{{ $invitation->bride_name }}</h3>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-white/50 mt-2" x-text="'Daughter of ' + (data.data.bride.father || 'Parents')">Daughter of Mr. & Mrs.</p>
                    </div>
                 </div>

                 <div class="love-center">
                    <i class="far fa-heart"></i>
                 </div>
            </div>
        </section>

        <!-- Events -->
        <section id="event" class="py-20 md:py-32 px-6">
            <div class="max-w-xl mx-auto minimal-card p-10 md:p-24 text-center rounded-[3rem] shadow-sm" data-aos="fade-up">
                 <h2 class="text-[10px] font-bold uppercase tracking-[0.5em] mb-12 text-slate-400">The Ceremony</h2>
                 <div class="space-y-10 md:space-y-12">
                     <div class="space-y-4">
                         <p class="text-2xl md:text-3xl font-extrabold tracking-tighter text-slate-900 border-b border-slate-100 pb-8 uppercase" x-text="formatDateFull(data.event_date)">{{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('l, d F Y') }}</p>
                         <p class="font-extrabold text-xs md:text-sm tracking-[0.2em] mt-8 uppercase" x-text="data.data.event.akad_time + ' — ' + data.data.event.resepsi_time + ' WIB'">09:00 — 13:00 WIB</p>
                     </div>
                     <div class="space-y-6">
                         <p class="font-bold text-slate-600 px-4 md:px-6 uppercase tracking-tight italic leading-relaxed" x-text="data.event_location">"{{ $invitation->event_location }}"</p>
                         <a :href="data.data.event.google_maps || 'https://maps.google.com'" target="_blank" class="inline-block px-10 py-3 bg-black text-white text-[9px] font-extrabold uppercase tracking-[0.3em] hover:scale-110 transition shadow-2xl">Direct Maps</a>
                     </div>
                 </div>
            </div>
        </section>

        <!-- Story Section -->
        <section id="story" class="py-20 md:py-32 px-6 bg-slate-50">
             <div class="max-w-4xl mx-auto" data-aos="fade-up">
                 <h2 class="text-[10px] font-bold uppercase tracking-[0.5em] text-center mb-20 text-slate-400">The Journey</h2>
                 <div class="space-y-16">
                    <template x-for="(item, index) in data.data.story" :key="index">
                        <div class="flex flex-col md:flex-row gap-6 md:gap-12">
                            <div class="md:w-32 text-2xl font-black text-slate-900 tracking-tighter shrink-0" x-text="item.year">2022</div>
                            <div class="flex-1 pb-12 border-l border-black pl-8 relative">
                                <div class="absolute left-[-4px] top-0 w-2 h-2 bg-black"></div>
                                <h4 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-4">Milestone</h4>
                                <p class="text-slate-800 font-bold tracking-tight text-lg md:text-xl" x-text="item.content">...</p>
                            </div>
                        </div>
                    </template>
                 </div>
             </div>
        </section>

        <!-- Gift Section -->
        <section id="gift" class="py-20 md:py-32 px-6">
             <div class="max-w-xl mx-auto text-center" data-aos="zoom-in">
                 <h2 class="text-[10px] font-bold uppercase tracking-[0.5em] mb-8 text-slate-400">The Registry</h2>
                 <p class="font-bold text-sm text-slate-500 mb-12">Should you wish to celebrate our union with a gift:</p>
                 
                 <div class="minimal-card p-12 md:p-20 border border-slate-100 space-y-12">
                    <div class="space-y-4">
                        <p class="text-[9px] font-black uppercase tracking-widest text-slate-300" x-text="data.data.gift.bank_name">BANK CENTRAL ASIA</p>
                        <h4 class="text-3xl md:text-5xl font-black tracking-tighter text-slate-900" x-text="data.data.gift.account_number">1234567890</h4>
                        <p class="text-[10px] uppercase font-bold tracking-widest text-slate-400" x-text="'HOLDER: ' + data.data.gift.account_holder">NAME ON CARD</p>
                    </div>
                    <button @click="navigator.clipboard.writeText(data.data.gift.account_number); alert('Copied!')" 
                        class="px-14 py-4 bg-black text-white text-[9px] font-black uppercase tracking-[0.4em] hover:bg-slate-800 transition shadow-xl">COPY DETAILS</button>
                 </div>
             </div>
        </section>

        <!-- Sticky Nav Bottom -->
        <div class="nav-bottom">
            <a href="#home" class="nav-item active">INT</a>
            <a href="#couple" class="nav-item">CPL</a>
            <a href="#story" class="nav-item">STR</a>
            <a href="#event" class="nav-item">EVT</a>
            <a href="#gift" class="nav-item">GFT</a>
        </div>
    </div>

    <!-- Music Player -->
    <iframe id="youtube-player" src="https://www.youtube.com/embed/jfKfPfyJRdk?enablejsapi=1&autoplay=0&loop=1&playlist=jfKfPfyJRdk" class="hidden" frameborder="0"></iframe>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        function themePreview() {
            return {
                isOpen: {{ request('preview') ? 'true' : 'false' }},
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
                        }
                    });
                    if (this.isOpen) {
                        setTimeout(() => AOS.init({ once: true, duration: 800 }), 500);
                    }
                },
                openInvitation() {
                    this.isOpen = true;
                    setTimeout(() => AOS.init({ once: true, duration: 800 }), 100);
                    var player = document.getElementById('youtube-player');
                    player.src = player.src.replace("autoplay=0", "autoplay=1");
                },
                formatDate(date) {
                    if (!date) return '';
                    const d = new Date(date);
                    return d.getDate().toString().padStart(2, '0') + ' . ' + (d.getMonth() + 1).toString().padStart(2, '0') + ' . ' + d.getFullYear();
                },
                formatDateFull(date) {
                    if (!date) return '';
                    return new Date(date).toLocaleDateString('id-ID', { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' });
                }
            }
        }
    </script>
</body>
</html>
