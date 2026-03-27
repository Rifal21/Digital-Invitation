<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $invitation->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700..900;1,700..900&family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #000; color: #d4af37; overflow: hidden; -webkit-tap-highlight-color: transparent; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-custom { background-color: {{ $invitation->theme_color }}; }
        .text-custom { color: {{ $invitation->theme_color }}; }
        
        #main-content { scroll-behavior: smooth; }

        /* Opening Overlay */
        #opening-overlay {
            position: fixed; inset: 0; z-index: 9999;
            background: #000;
            display: flex; align-items: center; justify-content: center;
            transition: transform 1.5s cubic-bezier(1, 0, 0, 1);
        }

        /* Nav Bottom */
        .nav-bottom {
            position: fixed; bottom: 15px; left: 50%; transform: translateX(-50%);
            background: rgba(0,0,0,0.9); backdrop-filter: blur(20px);
            border: 1px solid #d4af37; border-radius: 50px; padding: 10px 15px;
            display: flex; gap: 5px; box-shadow: 0 0 50px rgba(212,175,55,0.3); 
            z-index: 1000; width: 90%; max-width: 400px; justify-content: space-around;
        }
        .nav-item { color: #d4af37; font-size: 8px; font-weight: 900; text-transform: uppercase; opacity: 0.35; transition: 0.4s; flex: 1; text-align: center; }
        .nav-item.active { opacity: 1; text-shadow: 0 0 15px #d4af37; transform: translateY(-3px); }

        /* Diagonal Couple Split Premium */
        .couple-split {
            position: relative;
            height: 90vh;
            width: 100%;
            overflow: hidden;
            display: flex;
            background: #0a0a0a;
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
            clip-path: polygon(0 0, 75% 0, 25% 100%, 0 100%);
            border-right: 2px solid #d4af37;
        }
        .bride-half {
            z-index: 5;
            clip-path: polygon(75% 0, 100% 0, 100% 100%, 25% 100%);
        }
        .love-center {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            z-index: 20;
            width: 110px; height: 110px;
            background: #000;
            border: 2px solid #d4af37;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 50px rgba(212,175,55,0.4);
            color: #d4af37;
            font-size: 2.2rem;
            animation: pulse-royal 2s infinite;
        }

        @keyframes pulse-royal {
            0% { transform: translate(-50%, -50%) scale(1); box-shadow: 0 0 30px rgba(212,175,55,0.2); }
            50% { transform: translate(-50%, -50%) scale(1.1); box-shadow: 0 0 60px rgba(212,175,55,0.6); }
            100% { transform: translate(-50%, -50%) scale(1); box-shadow: 0 0 30px rgba(212,175,55,0.2); }
        }

        .royal-card {
            background: #0a0a0a;
            border: 1px solid #d4af37;
            box-shadow: 0 0 50px rgba(212,175,55,0.1);
            border-radius: 3rem;
        }

        .gold-float {
            position: fixed; pointer-events: none; z-index: 50;
            background: radial-gradient(circle, #ffe4b5 20%, transparent 60%);
            border-radius: 50%; opacity: 0.6;
            animation: sparkFloat 5s linear forwards;
        }
        @keyframes sparkFloat {
            0% { transform: translateY(110vh) scale(0); opacity: 1; }
            100% { transform: translateY(-10vh) scale(1.5); opacity: 0; }
        }

        @media (max-width: 640px) {
            .hero-title { font-size: 5rem !important; }
            .section-title { font-size: 3rem !important; }
            .couple-split { height: 75vh; }
            .love-center { width: 80px; height: 80px; font-size: 1.5rem; }
        }
    </style>
</head>
<body class="antialiased selection:bg-[#d4af37] selection:text-black" x-data="themePreview()" x-init="init()">

    <!-- Opening Overlay -->
    <div id="opening-overlay" :class="isOpen ? 'translate-y-full opacity-0 pointer-events-none' : ''">
        <div class="text-center px-6" data-aos="zoom-out" data-aos-duration="2000">
            <h4 class="text-[10px] font-black uppercase tracking-[0.8em] mb-10 opacity-60">The Grand Premiere</h4>
            <h1 class="font-serif text-5xl md:text-[9rem] leading-none mb-10 italic tracking-tighter uppercase" x-text="data.groom_name + ' & ' + data.bride_name">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h1>
            <div class="mb-12">
                 <p class="text-[10px] italic opacity-40 mb-2 font-bold uppercase tracking-widest">Special invitation for:</p>
                 <span class="text-white text-2xl md:text-3xl font-serif tracking-widest font-black uppercase border-b border-[#d4af37]/20 px-4">{{ request('to', 'Tamu Undangan') }}</span>
            </div>
            <button @click="openInvitation()" class="px-14 py-4 bg-[#d4af37] text-black text-[10px] font-black uppercase tracking-[0.5em] hover:bg-white transition duration-700 shadow-[0_0_40px_rgba(212,175,55,0.3)]">
                Unveil Invitation
            </button>
        </div>
    </div>

    <div id="main-content" class="h-screen overflow-y-auto" :class="!isOpen ? 'hidden' : ''">
        
        <!-- Hero -->
        <section id="home" class="min-h-screen flex items-center justify-center p-6 bg-[radial-gradient(circle_at_center,_#1a1a1a,_#000)] px-6">
            <div class="text-center z-10" data-aos="fade-up" data-aos-duration="2000">
                <span class="text-[9px] font-black tracking-[0.6em] uppercase opacity-20 mb-8 block">AN AMORA ROYAL PRODUCT</span>
                <h2 class="font-serif text-7xl md:text-[11rem] leading-none mb-14 tracking-tighter italic hero-title uppercase">
                    <span x-text="data.groom_name">{{ $invitation->groom_name }}</span> <br> <span class="not-italic opacity-10 font-light block">&</span> <span x-text="data.bride_name">{{ $invitation->bride_name }}</span>
                </h2>
                <div class="flex items-center justify-center gap-6 py-8 border-y border-[#d4af37]/10">
                    <p class="font-serif text-3xl md:text-4xl font-black uppercase tracking-widest" x-text="formatDate(data.event_date)">{{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d M Y') }}</p>
                </div>
            </div>
        </section>

        <!-- Couple Section -->
        <section id="couple" class="bg-black overflow-hidden">
            <div class="py-20 md:py-32 px-6 text-center" data-aos="fade-up">
                 <h2 class="font-serif text-5xl md:text-6xl italic section-title uppercase tracking-tighter">THE ROYALS</h2>
                 <div class="h-px w-20 bg-[#d4af37] mx-auto opacity-20 mt-6"></div>
            </div>

            <div class="couple-split" data-aos="fade-up">
                 <div class="couple-half groom-half grayscale brightness-50 hover:grayscale-0 hover:brightness-100 transition duration-1000" style="background-image: url('https://images.unsplash.com/photo-1550005810-350771a3f033?auto=format&fit=crop&w=1200&q=80')">
                    <div class="absolute bottom-10 left-10 md:bottom-20 md:left-20 z-30">
                        <h3 class="font-serif text-5xl md:text-8xl italic tracking-tighter text-white drop-shadow-2xl uppercase tracking-widest" x-text="data.groom_name">{{ $invitation->groom_name }}</h3>
                        <p class="text-[9px] md:text-[11px] font-black uppercase tracking-[0.4em] text-[#d4af37] mt-4 uppercase" x-text="'Son of ' + (data.data.groom.father || 'Parents')">Prince of Families</p>
                    </div>
                 </div>

                 <div class="couple-half bride-half grayscale brightness-50 hover:grayscale-0 hover:brightness-100 transition duration-1000" style="background-image: url('https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=1200&q=80')">
                    <div class="absolute top-10 right-10 md:top-20 md:right-20 z-30 text-right">
                        <h3 class="font-serif text-5xl md:text-8xl italic tracking-tighter text-white drop-shadow-2xl uppercase tracking-widest" x-text="data.bride_name">{{ $invitation->bride_name }}</h3>
                        <p class="text-[9px] md:text-[11px] font-black uppercase tracking-[0.4em] text-[#d4af37] mt-4 uppercase" x-text="'Daughter of ' + (data.data.bride.father || 'Parents')">Princess of Families</p>
                    </div>
                 </div>

                 <div class="love-center">
                    <i class="fas fa-crown"></i>
                 </div>
            </div>

            <div class="py-20 text-center px-10">
                <p class="text-[#d4af37] font-serif italic text-sm md:text-xl opacity-40 max-w-2xl mx-auto uppercase tracking-widest" x-text="data.data.general.quote">Two dynasties united by love...</p>
            </div>
        </section>

        <!-- Event -->
        <section id="event" class="py-20 md:py-32 px-6 relative overflow-hidden">
             <div class="max-w-2xl mx-auto royal-card p-10 md:p-32 text-center" data-aos="flip-up">
                 <h2 class="font-serif text-2xl md:text-3xl mb-12 uppercase tracking-[0.4em] italic opacity-40 border-b border-[#d4af37]/20 pb-10 uppercase">Proclamation</h2>
                 <div class="space-y-12 md:space-y-16">
                     <div class="space-y-6">
                        <p class="font-serif text-4xl md:text-6xl font-black uppercase tracking-tighter leading-tight px-2 uppercase" x-text="formatDateFull(data.event_date)">{{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('l, d F Y') }}</p>
                        <p class="text-[10px] md:text-xs font-black uppercase tracking-[0.6em] opacity-30 mt-8 uppercase" x-text="'COMMENCING AT ' + data.data.event.akad_time">COMMENCING AT 09:00 AM</p>
                     </div>
                     <div class="space-y-10">
                        <p class="font-serif text-xl md:text-2xl italic tracking-wide px-4 md:px-10 opacity-70 underline underline-offset-8 decoration-[#d4af37]/20 leading-relaxed italic uppercase" x-text="data.event_location">"{{ $invitation->event_location }}"</p>
                        <a :href="data.data.event.google_maps || 'https://maps.google.com'" target="_blank" class="inline-block px-12 py-4 border border-[#d4af37] text-[#d4af37] text-[10px] font-black uppercase tracking-[0.4em] hover:bg-[#d4af37] hover:text-black transition duration-700">GOOGLE MAPS ACCESS</a>
                     </div>
                 </div>
             </div>
        </section>

        <!-- Story Section -->
        <section id="story" class="py-20 md:py-40 px-6 relative">
             <div class="max-w-5xl mx-auto text-center" data-aos="fade-up">
                 <h2 class="font-serif text-3xl md:text-5xl mb-24 uppercase tracking-[0.5em] italic opacity-40">CHRONICLES</h2>
                 <div class="space-y-24 relative">
                    <div class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-px bg-[#d4af37]/20"></div>
                    
                    <template x-for="(item, index) in data.data.story" :key="index">
                        <div class="relative grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-40 items-center">
                            <div class="absolute left-1/2 -translate-x-1/2 w-4 h-4 bg-[#d4af37] rotate-45 z-10 border border-black shadow-[0_0_20px_rgba(212,175,55,0.8)]"></div>
                            
                            <div :class="index % 2 === 0 ? 'md:text-right' : 'md:order-last md:text-left'" class="px-6">
                                <span class="font-serif italic text-3xl md:text-5xl text-[#d4af37]/60 block mb-4" x-text="item.year">2022</span>
                                <h4 class="text-xs md:text-sm font-black text-white uppercase tracking-[0.4em] leading-relaxed" x-text="item.content">THE UNION OF HEARTS</h4>
                            </div>
                        </div>
                    </template>
                 </div>
             </div>
        </section>

        <!-- Gift Section -->
        <section id="gift" class="py-20 md:py-40 px-6 bg-[rgba(212,175,55,0.03)]">
             <div class="max-w-xl mx-auto text-center" data-aos="zoom-in">
                 <h2 class="font-serif text-3xl md:text-4xl mb-12 uppercase tracking-[0.6em] italic opacity-40">TREASURY</h2>
                 <p class="text-[10px] md:text-xs font-black uppercase tracking-[0.4em] text-[#d4af37]/60 mb-16 leading-loose px-4">YOUR PRESENCE IS THE ULTIMATE HONOR. SHOULD YOU WISH TO OFFER A TOKEN OF CELEBRATION, WE HUMBLY PROVIDE OUR DETAILS BELOW.</p>
                 
                 <div class="royal-card p-12 md:p-24 border-[#d4af37]/30 space-y-12">
                    <div class="space-y-4">
                        <p class="text-[9px] font-black uppercase tracking-[0.5em] text-[#d4af37]/40" x-text="data.data.gift.bank_name">ROYAL BANK OF COMMERCE</p>
                        <h4 class="text-3xl md:text-5xl font-serif font-black tracking-[0.4em] text-[#d4af37] drop-shadow-[0_0_20px_rgba(212,175,55,0.4)]" x-text="data.data.gift.account_number">1234567890</h4>
                        <p class="text-[10px] uppercase font-black tracking-[0.8em] text-white/40" x-text="'HOLDER: ' + data.data.gift.account_holder">HOLDER: THE CROWN</p>
                    </div>
                    <button @click="navigator.clipboard.writeText(data.data.gift.account_number); alert('Treasury details copied to clipboard!')" 
                        class="px-14 py-4 border border-[#d4af37] text-black bg-[#d4af37] text-[9px] font-black uppercase tracking-[0.5em] hover:bg-white hover:text-black hover:border-white transition duration-700">TRANSFER TO TREASURY</button>
                 </div>
             </div>
        </section>

        <!-- Sticky Nav Bottom -->
        <div class="nav-bottom">
            <a href="#home" class="nav-item active">INT</a>
            <a href="#couple" class="nav-item">ROY</a>
            <a href="#story" class="nav-item">CHR</a>
            <a href="#event" class="nav-item">EVN</a>
            <a href="#gift" class="nav-item">TRS</a>
        </div>
    </div>

    <!-- Music Player -->
    <iframe id="youtube-player" src="https://www.youtube.com/embed/jfKfPfyJRdk?enablejsapi=1&autoplay=0&loop=1&playlist=jfKfPfyJRdk" class="hidden" frameborder="0"></iframe>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        function themePreview() {
            return {
                isOpen: false,
                activeSection: 'home',
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
                            this.$nextTick(() => {
                                AOS.refresh();
                            });
                        }
                    });
                },
                openInvitation() {
                    this.isOpen = true;
                    setTimeout(() => {
                        AOS.init({ once: true, duration: 1500 });
                        var player = document.getElementById('youtube-player');
                        player.src = player.src.replace("autoplay=0", "autoplay=1");
                        this.startGoldRain();
                    }, 100);
                },
                formatDate(date) {
                    if (!date) return '';
                    const d = new Date(date);
                    return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                },
                formatDateFull(date) {
                    if (!date) return '';
                    const d = new Date(date);
                    return d.toLocaleDateString('id-ID', { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' });
                },
                startGoldRain() {
                    setInterval(() => {
                        const spark = document.createElement('div');
                        spark.classList.add('gold-float');
                        spark.innerHTML = '<i class="fas fa-sparkles text-[4px]"></i>';
                        spark.style.left = Math.random() * 100 + 'vw';
                        spark.style.animationDuration = (Math.random() * 2 + 3) + 's';
                        document.body.appendChild(spark);
                        setTimeout(() => spark.remove(), 5000);
                    }, 600);
                }
            }
        }
    </script>
</body>
</html>
