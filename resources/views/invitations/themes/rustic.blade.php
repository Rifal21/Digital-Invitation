<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $invitation->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #fcf8f3; color: #5d4037; overflow: hidden; -webkit-tap-highlight-color: transparent; }
        .font-serif { font-family: 'Cormorant Garamond', serif; }
        .bg-custom { background-color: {{ $invitation->theme_color }}; }
        .text-custom { color: {{ $invitation->theme_color }}; }
        
        #main-content { scroll-behavior: smooth; }

        /* Opening Overlay */
        #opening-overlay {
            position: fixed; inset: 0; z-index: 9999;
            background: linear-gradient(rgba(252,248,243,0.92), rgba(252,248,243,0.92)), 
                        url('https://images.unsplash.com/photo-1518196775791-308ad33b3793?auto=format&fit=crop&w=1920&q=80');
            background-size: cover; background-position: center;
            display: flex; align-items: center; justify-content: center;
            transition: opacity 1.5s ease-out;
        }

        /* Nav Bottom */
        .nav-bottom {
            position: fixed; bottom: 15px; left: 50%; transform: translateX(-50%);
            background: rgba(93, 64, 55, 0.9); backdrop-filter: blur(10px);
            border-radius: 40px; padding: 10px 15px;
            display: flex; gap: 5px; box-shadow: 0 10px 40px rgba(0,0,0,0.15); 
            z-index: 1000; width: 90%; max-width: 400px; justify-content: space-around;
        }
        .nav-item { color: #fcf8f3; font-size: 8px; font-weight: bold; text-transform: uppercase; opacity: 0.5; transition: 0.3s; flex: 1; text-align: center; }
        .nav-item.active { opacity: 1; border-bottom: 2px solid #fcf8f3; transform: translateY(-2px); }

        /* Diagonal Couple Split */
        .couple-split {
            position: relative;
            height: 90vh;
            width: 100%;
            overflow: hidden;
            display: flex;
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
            clip-path: polygon(0 0, 65% 0, 35% 100%, 0 100%);
            border-right: 2px solid #fcf8f3;
        }
        .bride-half {
            z-index: 5;
            clip-path: polygon(65% 0, 100% 0, 100% 100%, 35% 100%);
        }
        .love-center {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            z-index: 20;
            width: 85px; height: 85px;
            background: #fcf8f3;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 10px 30px rgba(93,64,55,0.15);
            color: #d63031;
            font-size: 1.8rem;
            animation: pulse-rustic 2s infinite;
        }

        @keyframes pulse-rustic {
            0% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
            50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.8; }
            100% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
        }

        .rustic-card {
            background: #ffffff;
            border-radius: 35px;
            box-shadow: 0 40px 80px rgba(93, 64, 55, 0.05);
            border: 1px solid rgba(93, 64, 55, 0.05);
        }

        .flower-float {
            position: fixed; pointer-events: none; z-index: 50; opacity: 0.3;
            animation: float 8s linear forwards;
        }
        @keyframes float {
            0% { transform: translateY(110vh) rotate(0); }
            100% { transform: translateY(-10vh) rotate(360deg); }
        }

        .polaroid {
            background: #fff;
            padding: 10px 10px 35px 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transform: rotate(-2deg);
        }

        @media (max-width: 640px) {
            .hero-title { font-size: 4.5rem !important; }
            .section-title { font-size: 3rem !important; }
            .couple-split { height: 75vh; }
            .love-center { width: 65px; height: 65px; font-size: 1.2rem; }
        }
    </style>
</head>
<body class="antialiased selection:bg-[#5d4037] selection:text-white" x-data="themePreview()" x-init="init()">

    <!-- Opening Overlay -->
    <div id="opening-overlay" :class="isOpen ? 'opacity-0 pointer-events-none' : ''">
        <div class="text-center px-6">
            <h4 class="font-serif italic text-xl md:text-2xl text-slate-400 mb-6 font-bold uppercase tracking-widest">The Wedding of</h4>
            <h1 class="font-serif text-5xl md:text-8xl text-[#4e342e] leading-tight mb-10 italic tracking-tighter" x-text="data.groom_name + ' & ' + data.bride_name">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h1>
            <div class="mb-10">
                 <p class="text-[10px] md:text-sm uppercase tracking-widest opacity-60 mb-2 font-bold uppercase">Dear honored guest:</p>
                 <span class="text-xl md:text-2xl font-serif font-bold italic border-b border-[#5d4037]/20 px-4">{{ request('to', 'Tamu Undangan') }}</span>
            </div>
            <button @click="openInvitation()" class="px-10 py-4 bg-[#5d4037] text-white text-[10px] font-bold uppercase tracking-[0.3em] rounded-full shadow-2xl hover:scale-105 transition">
                Open Invitation
            </button>
        </div>
    </div>

    <div id="main-content" class="h-screen overflow-y-auto" :class="!isOpen ? 'hidden' : ''">
        
        <!-- Hero -->
        <section id="home" class="min-h-screen flex items-center justify-center p-6 bg-[radial-gradient(circle_at_center,_#fff,_#fcf8f3)] px-6">
            <div class="text-center" data-aos="zoom-out">
                <span class="font-serif italic text-xl md:text-2xl opacity-40 block mb-6 px-4">Together with Our Families</span>
                <h2 class="font-serif text-6xl md:text-[10rem] text-[#4e342e] leading-none mb-10 tracking-tight italic hero-title">
                    <span x-text="data.groom_name">{{ $invitation->groom_name }}</span> <br> <span class="text-custom font-light italic text-2xl md:text-4xl">&</span> <br> <span x-text="data.bride_name">{{ $invitation->bride_name }}</span>
                </h2>
                <div class="h-px w-16 md:w-24 bg-[#5d4037]/20 mx-auto mb-10"></div>
                <p class="text-lg md:text-2xl font-serif text-[#5d4037] tracking-[0.3em] font-bold uppercase" x-text="formatDate(data.event_date)">{{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d . m . Y') }}</p>
            </div>
        </section>

        <!-- Couple Section -->
        <section id="couple" class="bg-white overflow-hidden">
            <div class="py-20 md:py-32 px-6 text-center" data-aos="fade-up">
                 <h2 class="font-serif text-5xl md:text-6xl mb-4 italic text-[#4e342e] section-title uppercase tracking-tighter">THE SOULS</h2>
                 <p class="text-[9px] uppercase tracking-[0.4em] opacity-40 font-black">United by nature's warm embrace</p>
            </div>

            <div class="couple-split" data-aos="fade-up">
                 <div class="couple-half groom-half grayscale brightness-90 hover:grayscale-0 hover:brightness-100 transition duration-1000" style="background-image: url('https://images.unsplash.com/photo-1550005810-350771a3f033?auto=format&fit=crop&w=1200&q=80')">
                    <div class="absolute bottom-10 left-10 md:bottom-20 md:left-20 z-30">
                        <h3 class="font-serif text-4xl md:text-7xl text-white italic tracking-tighter drop-shadow-xl" x-text="data.groom_name">{{ $invitation->groom_name }}</h3>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-[#fcf8f3]/80 mt-2" x-text="'Son of ' + (data.data.groom.father || 'Parents')">Son of Mr. & Mrs. Parents</p>
                    </div>
                 </div>

                 <div class="couple-half bride-half grayscale brightness-90 hover:grayscale-0 hover:brightness-100 transition duration-1000" style="background-image: url('https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=1200&q=80')">
                    <div class="absolute top-10 right-10 md:top-20 md:right-20 z-30 text-right">
                        <h3 class="font-serif text-4xl md:text-7xl text-white italic tracking-tighter drop-shadow-xl" x-text="data.bride_name">{{ $invitation->bride_name }}</h3>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-[#fcf8f3]/80 mt-2" x-text="'Daughter of ' + (data.data.bride.father || 'Parents')">Daughter of Mr. & Mrs. Parents</p>
                    </div>
                 </div>

                 <div class="love-center">
                    <i class="fas fa-heart"></i>
                 </div>
            </div>

            <div class="py-20 text-center px-10">
                <p class="text-slate-400 font-serif italic text-sm md:text-base px-10" x-text="data.data.general.quote">Two lives, two hearts...</p>
            </div>
        </section>

        <!-- Event -->
        <section id="event" class="py-20 md:py-32 px-6 bg-slate-50 relative overflow-hidden">
             <div class="max-w-2xl mx-auto rustic-card p-10 md:p-32 text-center" data-aos="flip-up">
                 <h2 class="font-serif text-2xl md:text-4xl mb-10 md:mb-12 italic text-custom opacity-70 border-b-2 border-[#5d4037]/10 pb-6 uppercase">Waktu & Tempat</h2>
                 <div class="space-y-10 md:space-y-12">
                     <div class="space-y-4">
                        <p class="font-serif text-3xl md:text-5xl italic font-black tracking-tight leading-tight px-2" x-text="formatDateFull(data.event_date)">{{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('l, d F Y') }}</p>
                        <p class="text-[10px] md:text-[11px] font-extrabold uppercase tracking-[0.4em] opacity-30 mt-6 uppercase" x-text="'Pukul ' + data.data.event.akad_time + ' WIB - Selesai'">Pukul 09:00 WIB - Selesai</p>
                     </div>
                     <div class="space-y-8">
                        <p class="font-serif text-xl md:text-2xl italic leading-relaxed px-4 md:px-10 text-slate-600" x-text="data.event_location">"{{ $invitation->event_location }}"</p>
                        <a :href="data.data.event.google_maps || 'https://maps.google.com'" target="_blank" class="inline-block px-10 py-3.5 bg-[#5d4037] text-white rounded-full text-[9px] md:text-[10px] font-extrabold uppercase tracking-[0.3em] shadow-xl hover:bg-black transition duration-500">Google Maps</a>
                     </div>
                 </div>
             </div>
        </section>

        <!-- Sticky Nav Bottom -->
        <div class="nav-bottom">
            <a href="#home" class="nav-item active">INT</a>
            <a href="#couple" class="nav-item">CPL</a>
            <a href="#event" class="nav-item">EVT</a>
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
                        setTimeout(() => { AOS.init({ once: true, duration: 1200 }); this.startLeavesSnow(); }, 500);
                    }
                },
                openInvitation() {
                    this.isOpen = true;
                    setTimeout(() => { AOS.init({ once: true, duration: 1200 }); this.startLeavesSnow(); }, 100);
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
                },
                startLeavesSnow() {
                    setInterval(() => {
                        const leaf = document.createElement('div');
                        leaf.classList.add('flower-float');
                        leaf.innerHTML = '<i class="fas fa-leaf"></i>';
                        leaf.style.left = Math.random() * 100 + 'vw';
                        leaf.style.animationDuration = (Math.random() * 4 + 4) + 's';
                        document.body.appendChild(leaf);
                        setTimeout(() => leaf.remove(), 8000);
                    }, 1000);
                }
            }
        }
    </script>
</body>
</html>
