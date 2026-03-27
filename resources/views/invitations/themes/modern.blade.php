<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; overflow: hidden; -webkit-tap-highlight-color: transparent; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-custom { background-color: {{ $invitation->theme_color }}; }
        .text-custom { color: {{ $invitation->theme_color }}; }
        
        #main-content { scroll-behavior: smooth; }

        /* Opening Overlay */
        #opening-overlay {
            position: fixed; inset: 0; z-index: 9999;
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1920&q=80');
            background-size: cover; background-position: center;
            transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1);
        }

        /* Nav Bottom */
        .nav-bottom {
            position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%);
            background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);
            border-radius: 50px; padding: 10px 15px; display: flex; gap: 5px;
            box-shadow: 0 10px 50px rgba(0,0,0,0.12); z-index: 1000;
            width: 90%; max-width: 400px; justify-content: space-around;
        }
        .nav-item { color: #64748b; font-size: 8px; font-weight: bold; text-transform: uppercase; transition: 0.3s; opacity: 0.5; flex: 1; text-align: center; }
        .nav-item.active { color: {{ $invitation->theme_color }}; opacity: 1; transform: translateY(-2px); }

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
            clip-path: polygon(0 0, 70% 0, 30% 100%, 0 100%);
            border-right: 3px solid white;
        }
        .bride-half {
            z-index: 5;
            clip-path: polygon(70% 0, 100% 0, 100% 100%, 30% 100%);
        }
        .love-center {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            z-index: 20;
            width: 100px; height: 100px;
            background: white;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            color: #ef4444;
            font-size: 2.22rem;
            animation: pulse-love 2s infinite;
        }

        @keyframes pulse-love {
            0% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.1); box-shadow: 0 0 50px rgba(239, 68, 68, 0.4); }
            100% { transform: translate(-50%, -50%) scale(1); }
        }

        .flower-float {
            position: fixed; pointer-events: none; z-index: 50; opacity: 0.4;
            animation: float 6s linear forwards;
        }
        @keyframes float {
            0% { transform: translateY(110vh) rotate(0); }
            100% { transform: translateY(-10vh) rotate(360deg); }
        }

        @media (max-width: 640px) {
            .hero-title { font-size: 4.5rem !important; }
            .section-title { font-size: 2.5rem !important; }
            .couple-split { height: 75vh; }
            .love-center { width: 70px; height: 70px; font-size: 1.5rem; }
        }
    </style>
</head>
<body class="antialiased selection:bg-custom selection:text-white overflow-x-hidden" 
      x-data="themePreview(@json($invitation))"
      x-init="initPreview()">

    <!-- Opening Overlay -->
    <div id="opening-overlay" class="flex items-center justify-center" x-show="!isOpen" x-transition:leave="transition ease-in duration-1000 transform -translate-y-full">
        <div class="text-center text-white px-6">
            <h4 class="text-[10px] uppercase tracking-[0.5em] mb-4 font-light opacity-60">The Wedding of</h4>
            <h1 class="font-serif text-5xl md:text-9xl mb-8 leading-tight tracking-tighter">
                <span x-text="data.groom_name">{{ $invitation->groom_name }}</span> 
                <span class="text-white/30">&</span> 
                <span x-text="data.bride_name">{{ $invitation->bride_name }}</span>
            </h1>
            <div class="mb-12">
                 <p class="font-light italic text-sm md:text-lg opacity-80 mb-2">Special Invitation for:</p>
                 <span class="font-bold text-xl md:text-2xl tracking-tight">{{ request('to', 'Tamu Undangan') }}</span>
            </div>
            <button @click="openInvitation()" class="bg-white text-gray-900 px-10 py-4 rounded-full font-bold uppercase tracking-widest text-[10px] md:text-[11px] hover:scale-105 transition duration-500 shadow-2xl">
                Buka Undangan
            </button>
        </div>
    </div>

    <div id="main-content" class="h-screen overflow-y-auto" :class="isOpen ? '' : 'hidden'">
        <!-- Hero Section -->
        <section id="home" class="min-h-screen flex items-center justify-center relative overflow-hidden bg-slate-50 px-6">
            <div class="absolute inset-0 opacity-5" style="background-image: url('https://www.transparenttextures.com/patterns/natural-paper.png');"></div>
            <div class="text-center z-10" data-aos="zoom-out" data-aos-duration="2000">
                <span class="text-[10px] font-bold uppercase tracking-[0.8em] text-gray-400 block mb-6">Save the Date</span>
                <h2 class="font-serif text-6xl md:text-[10rem] text-gray-900 leading-none hero-title">
                    <span x-text="data.groom_name">{{ $invitation->groom_name }}</span> <br> & <br> <span x-text="data.bride_name">{{ $invitation->bride_name }}</span>
                </h2>
                <div class="mt-8 md:mt-12 flex items-center justify-center gap-4 md:gap-6">
                    <div class="h-px w-8 md:w-12 bg-custom/30"></div>
                    <p class="font-serif text-xl md:text-3xl italic tracking-widest" x-text="formatDate(data.event_date)">{{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d . m . Y') }}</p>
                    <div class="h-px w-8 md:w-12 bg-custom/30"></div>
                </div>
            </div>
        </section>

        <!-- Couple Section -->
        <section id="couple" class="bg-white overflow-hidden pb-20">
            <div class="py-20 md:py-32 px-6 text-center" data-aos="fade-up">
                <h2 class="font-serif text-4xl md:text-5xl mb-4 italic section-title">Mempelai</h2>
                <div class="h-px w-20 bg-custom mx-auto opacity-20"></div>
            </div>

            <div class="couple-split" data-aos="fade-up">
                <!-- Groom -->
                <div class="couple-half groom-half" style="background-image: url('https://images.unsplash.com/photo-1550005810-350771a3f033?auto=format&fit=crop&w=1200&q=80')">
                    <div class="absolute bottom-10 left-10 md:bottom-20 md:left-20 z-30">
                        <h3 class="font-serif text-4xl md:text-7xl text-white drop-shadow-xl" x-text="data.data.groom.full_name || data.groom_name">{{ $invitation->data['groom']['full_name'] ?? $invitation->groom_name }}</h3>
                        <p class="text-[9px] md:text-xs font-bold uppercase tracking-widest text-white/70 mt-3 italic">
                            Putra dari <span x-text="data.data.groom.father">{{ $invitation->data['groom']['father'] ?? '' }}</span> & <span x-text="data.data.groom.mother">{{ $invitation->data['groom']['mother'] ?? '' }}</span>
                        </p>
                    </div>
                </div>

                <!-- Bride -->
                <div class="couple-half bride-half" style="background-image: url('https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=1200&q=80')">
                    <div class="absolute top-10 right-10 md:top-20 md:right-20 z-30 text-right">
                        <h3 class="font-serif text-4xl md:text-7xl text-white drop-shadow-xl" x-text="data.data.bride.full_name || data.bride_name">{{ $invitation->data['bride']['full_name'] ?? $invitation->bride_name }}</h3>
                        <p class="text-[9px] md:text-xs font-bold uppercase tracking-widest text-white/70 mt-3 italic">
                            Putri dari <span x-text="data.data.bride.father">{{ $invitation->data['bride']['father'] ?? '' }}</span> & <span x-text="data.data.bride.mother">{{ $invitation->data['bride']['mother'] ?? '' }}</span>
                        </p>
                    </div>
                </div>

                <div class="love-center">
                    <i class="fas fa-heart"></i>
                </div>
            </div>
            
            <div class="max-w-xl mx-auto text-center mt-20 px-8">
                <p class="font-serif italic text-slate-400 text-lg md:text-xl" x-text="data.data.general.quote">{{ $invitation->data['general']['quote'] ?? '' }}</p>
            </div>
        </section>

        <!-- Event Details Section -->
        <section id="event" class="py-20 md:py-32 px-6 bg-slate-50 relative overflow-hidden">
             <div class="max-w-xl mx-auto bg-white p-10 md:p-20 text-center relative z-10 rounded-[3rem] shadow-xl border border-slate-100" data-aos="flip-up">
                 <h2 class="font-serif text-3xl md:text-4xl mb-12 border-b pb-8 border-custom/10 italic">Waktu & Tempat</h2>
                 <div class="space-y-12">
                     <div class="space-y-4">
                         <p class="font-serif text-2xl md:text-4xl font-black text-custom italic" x-text="formatFullDate(data.event_date)">{{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('l, d F Y') }}</p>
                         <div class="flex justify-center gap-8 pt-4">
                            <div>
                                <p class="text-[8px] font-black uppercase text-slate-400 tracking-widest mb-1">Akad Nikah</p>
                                <p class="text-sm font-bold" x-text="data.data.event.akad_time">{{ $invitation->data['event']['akad_time'] ?? '' }}</p>
                            </div>
                            <div class="w-px h-8 bg-slate-100"></div>
                            <div>
                                <p class="text-[8px] font-black uppercase text-slate-400 tracking-widest mb-1">Resepsi</p>
                                <p class="text-sm font-bold" x-text="data.data.event.resepsi_time">{{ $invitation->data['event']['resepsi_time'] ?? '' }}</p>
                            </div>
                         </div>
                     </div>
                     <div class="space-y-4">
                        <p class="text-slate-400 text-[10px] uppercase font-black tracking-widest">— Berlokasi di —</p>
                        <p class="text-slate-600 font-serif italic text-lg md:text-2xl leading-relaxed" x-text="data.event_location">{{ $invitation->event_location }}</p>
                     </div>

                     <!-- Google Maps Embed -->
                     <div x-show="data.data.event.google_maps" class="mt-8 rounded-3xl overflow-hidden shadow-inner bg-slate-100 border border-slate-200" style="min-height: 200px">
                        <template x-if="data.data.event.google_maps.includes('<iframe')">
                            <div class="w-full h-full" x-html="data.data.event.google_maps"></div>
                        </template>
                        <template x-if="!data.data.event.google_maps.includes('<iframe') && data.data.event.google_maps.length > 5">
                            <div class="p-8 flex flex-col items-center justify-center space-y-4">
                                <i class="fas fa-map-marked-alt text-4xl text-custom/20"></i>
                                <a :href="data.data.event.google_maps" target="_blank" class="text-xs font-black uppercase tracking-widest text-custom underline">Lihat di Google Maps</a>
                            </div>
                        </template>
                     </div>

                     <div class="pt-8">
                        <a :href="extractUrl(data.data.event.google_maps) || 'https://maps.google.com'" target="_blank" class="inline-block px-12 py-4 bg-custom text-white rounded-full text-[10px] font-black uppercase tracking-[0.3em] shadow-xl hover:bg-slate-900 transition duration-500">Buka Navigasi</a>
                     </div>
                 </div>
             </div>
        </section>

        <!-- Story Section -->
        <section id="story" class="py-20 md:py-32 px-6 bg-white overflow-hidden">
             <div class="max-w-4xl mx-auto" data-aos="fade-up">
                 <h2 class="font-serif text-3xl md:text-5xl text-center mb-20 italic">Timeline Cinta</h2>
                 <div class="space-y-12">
                    <template x-for="(item, index) in data.data.story" :key="index">
                        <div class="flex items-start gap-8" :class="index % 2 === 1 ? 'flex-row-reverse text-right' : ''">
                            <div class="w-24 shrink-0 font-serif text-3xl text-custom italic opacity-30 pt-1" x-text="item.year">2022</div>
                            <div class="flex-1 p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 shadow-sm">
                                <p class="text-sm font-bold uppercase tracking-widest text-slate-400 mb-2">Our Chapter</p>
                                <p class="text-slate-600 leading-relaxed font-serif italic text-lg" x-text="item.content">...</p>
                            </div>
                        </div>
                    </template>
                 </div>
             </div>
        </section>

        <!-- Gift Section -->
        <section id="gift" class="py-20 md:py-32 px-6 bg-slate-50">
             <div class="max-w-xl mx-auto text-center" data-aos="zoom-in">
                 <h2 class="font-serif text-3xl md:text-4xl mb-6 italic">Wedding Gift</h2>
                 <p class="text-slate-400 text-sm mb-12">Kehadiran Anda adalah kado terpenting bagi kami. Namun bagi Anda yang ingin memberikan tanda kasih lainnya:</p>
                 
                 <div class="bg-white p-12 md:p-20 rounded-[4rem] shadow-2xl space-y-10 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition">
                        <i class="fas fa-gift text-8xl text-custom"></i>
                    </div>
                    <div class="space-y-3 relative z-10">
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-custom" x-text="data.data.gift.bank_name">BCA DIGITAL</p>
                        <h4 class="text-3xl md:text-4xl font-serif font-black tracking-widest text-slate-800" x-text="data.data.gift.account_number">1234567890</h4>
                        <p class="text-xs uppercase font-bold tracking-widest text-slate-400" x-text="'Atas Nama: ' + data.data.gift.account_holder">...</span></p>
                    </div>
                    <button @click="navigator.clipboard.writeText(data.data.gift.account_number); alert('Rekening disalin!')" 
                        class="px-12 py-4 bg-custom text-white rounded-full text-[10px] font-black uppercase tracking-[0.3em] shadow-xl hover:shadow-custom/20 transition duration-500">Salin No. Rekening</button>
                 </div>
             </div>
        </section>

        <!-- Navigation Bottom -->
        <div class="nav-bottom">
            <a href="#home" class="nav-item active">Hme</a>
            <a href="#couple" class="nav-item">Cpl</a>
            <a href="#story" class="nav-item">Sty</a>
            <a href="#event" class="nav-item">Evt</a>
            <a href="#gift" class="nav-item">Gft</a>
        </div>
    </div>

    <!-- Music Player -->
    <iframe id="youtube-player" src="https://www.youtube.com/embed/jfKfPfyJRdk?enablejsapi=1&autoplay=0&loop=1&playlist=jfKfPfyJRdk" class="hidden" frameborder="0"></iframe>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        function themePreview(initialData) {
            return {
                isOpen: {{ request('preview') ? 'true' : 'false' }},
                data: initialData,
                
                initPreview() {
                    window.addEventListener('message', (event) => {
                        if (event.data.type === 'UPDATE_DATA') {
                            this.data = event.data.payload;
                            console.log('Theme Data Updated', this.data);
                        }
                    });

                    if (this.isOpen) {
                        setTimeout(() => {
                            AOS.init({ once: true, duration: 1200 });
                        }, 500);
                    }
                },

                openInvitation() {
                    this.isOpen = true;
                    setTimeout(() => {
                        AOS.init({ once: true, duration: 1200 });
                    }, 100);
                    
                    var player = document.getElementById('youtube-player');
                    player.src = player.src.replace("autoplay=0", "autoplay=1");
                },

                formatDate(dateStr) {
                    if (!dateStr) return '';
                    const d = new Date(dateStr);
                    return d.getDate().toString().padStart(2, '0') + ' . ' + (d.getMonth() + 1).toString().padStart(2, '0') + ' . ' + d.getFullYear();
                },

                formatFullDate(dateStr) {
                    if (!dateStr) return '';
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    return new Date(dateStr).toLocaleDateString('id-ID', options);
                }
            }
        }
    </script>
</body>
</html>
