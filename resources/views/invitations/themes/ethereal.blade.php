<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $invitation->title }} - Ethereal Garden Edition</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', sans-serif; overflow-x: hidden; scroll-behavior: smooth; background: #fdfaf6; }
        .font-serif { font-family: 'Cormorant Garamond', serif; }
        
        /* Floating Florals Animation */
        .flower-float {
            position: fixed;
            z-index: -1;
            opacity: 0.15;
            animation: float 10s ease-in-out infinite;
            filter: blur(2px);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0); }
            50% { transform: translateY(-30px) rotate(10deg); }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 40px 100px rgba(0,0,0,0.05);
        }

        .gold-gradient-text {
            background: linear-gradient(135deg, #d4af37 0%, #ecd4b2 50%, #d4af37 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .envelope-wrapper {
            transition: all 1.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .divider-floral {
            background: url('https://www.transparenttextures.com/patterns/natural-paper.png');
        }
    </style>
</head>
<body class="antialiased selection:bg-[#4D243D] selection:text-white" x-data="themePreview()" x-init="init()">

    <!-- AOS Wrapper -->
    <div id="wrapper" class="relative overflow-hidden">
        
        <!-- Florals (Static BG) -->
        <div class="flower-float top-10 -left-10 w-64 h-64"><svg fill="currentColor" viewBox="0 0 200 200" class="text-[#4D243D]"><path d="M100 0c-27.6 0-50 22.4-50 50s22.4 50 50 50 50-22.4 50-50-22.4-50-50-50z"/></svg></div>
        <div class="flower-float bottom-20 -right-20 w-80 h-80 delay-75"><svg fill="currentColor" viewBox="0 0 200 200" class="text-[#D0A98F]"><path d="M100 0c-27.6 0-50 22.4-50 50s22.4 50 50 50 50-22.4 50-50-22.4-50-50-50z"/></svg></div>

        <!-- 1. Section Full Height -->
        <section id="opening" class="min-h-screen flex items-center justify-center p-6 bg-[radial-gradient(circle_at_center,_#fff,_#fdfaf6)] relative">
            <div class="text-center space-y-8" data-aos="zoom-out">
                <p class="text-[10px] font-bold uppercase tracking-[0.6em] text-slate-400">The Wedding Celebration</p>
                <h1 class="font-serif text-6xl md:text-[7rem] leading-none text-[#4D243D] font-light">
                    <span x-text="data.groom_name">{{ $invitation->groom_name }}</span> <br> <span class="text-3xl italic opacity-30 font-light">&</span> <br> <span x-text="data.bride_name">{{ $invitation->bride_name }}</span>
                </h1>
                <div class="h-px w-24 bg-[#4D243D]/10 mx-auto"></div>
                <div class="text-sm font-medium tracking-widest text-slate-500 uppercase">
                    SAVE THE DATE <br> 
                    <span class="text-xl font-serif text-[#4D243D] mt-4 block" x-text="formatDate(data.event_date)">{{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d . m . Y') }}</span>
                </div>
            </div>
        </section>

        <!-- 2. Couple Section -->
        <section class="py-32 px-6">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-24" data-aos="fade-up">
                    <h2 class="font-serif text-5xl text-[#4D243D] mb-4">Mempelai Berbahagia</h2>
                    <p class="text-xs uppercase tracking-widest text-[#D0A98F] font-bold" x-text="data.data.general.quote">Kami berjanji setia selamanya</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
                    <div class="text-center" data-aos="fade-right">
                        <div class="relative inline-block mb-10">
                            <div class="w-64 h-64 rounded-t-full bg-slate-100 overflow-hidden shadow-2xl relative z-10">
                                <img src="https://images.unsplash.com/photo-1550005810-350771a3f033?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <h3 class="font-serif text-4xl text-[#4D243D]" x-text="data.groom_name">{{ $invitation->groom_name }}</h3>
                        <p class="text-sm font-serif italic text-slate-500 mt-2" x-text="'Putra Tercinta dari ' + (data.data.groom.father || 'Bpk & Ibu')">Putra Tercinta dari Bpk & Ibu</p>
                    </div>

                    <div class="text-center" data-aos="fade-left">
                        <div class="relative inline-block mb-10">
                            <div class="w-64 h-64 rounded-t-full bg-slate-100 overflow-hidden shadow-2xl relative z-10">
                                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <h3 class="font-serif text-4xl text-[#4D243D]" x-text="data.bride_name">{{ $invitation->bride_name }}</h3>
                        <p class="text-sm font-serif italic text-slate-500 mt-2" x-text="'Putri Tercinta dari ' + (data.data.bride.father || 'Bpk & Ibu')">Putri Tercinta dari Bpk & Ibu</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Story Section -->
        <section class="py-32 px-6">
            <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
                <h2 class="font-serif text-5xl text-[#4D243D] mb-16 italic">Our Eternal Story</h2>
                <div class="space-y-16">
                    <template x-for="(item, index) in data.data.story" :key="index">
                        <div class="flex flex-col items-center">
                            <span class="text-3xl font-serif text-[#D0A98F] mb-4 italic" x-text="item.year">2022</span>
                            <div class="h-px w-12 bg-[#4D243D]/10 mb-6"></div>
                            <p class="text-slate-600 font-serif text-lg md:text-xl italic max-w-2xl" x-text="item.content">...</p>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <!-- Gift Section -->
        <section class="py-32 px-6 bg-[#fdfaf6]">
            <div class="max-w-xl mx-auto text-center" data-aos="zoom-in">
                <h2 class="font-serif text-4xl text-[#4D243D] mb-8">Wedding Gift</h2>
                <p class="text-slate-400 text-sm italic font-serif mb-12">Your warm wishes are our greatest gift. If you'd like to contribute in another way, we've provided our details below.</p>
                
                <div class="glass-card p-12 md:p-20 border border-[#D0A98F]/20 rounded-[4rem]">
                    <div class="space-y-4">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-[#D0A98F]/60" x-text="data.data.gift.bank_name">BANK CENTRAL ASIA</p>
                        <h4 class="text-3xl md:text-4xl font-serif text-[#4D243D] italic" x-text="data.data.gift.account_number">1234567890</h4>
                        <p class="text-xs uppercase font-bold tracking-widest text-slate-400" x-text="'a/n ' + data.data.gift.account_holder">HOLDER NAME</p>
                    </div>
                    <button @click="navigator.clipboard.writeText(data.data.gift.account_number); alert('Copied!')" 
                        class="mt-10 px-12 py-4 bg-[#4D243D] text-white rounded-full text-[10px] font-bold uppercase tracking-widest transition shadow-2xl">Copy Registry Details</button>
                </div>
            </div>
        </section>

        <!-- 3. Event Details Section -->
        <section class="py-32 px-6 bg-white divider-floral">
            <div class="max-w-xl mx-auto glass-card rounded-[50px] p-12 md:p-24 text-center border-t border-[#4D243D]/5" data-aos="flip-up">
                <span class="text-[10px] font-bold uppercase tracking-[0.5em] text-[#D0A98F] block mb-10">Wedding Information</span>
                
                <h2 class="font-serif text-4xl text-[#4D243D] mb-6">Waktu & Tempat</h2>
                <div class="py-8 border-y border-[#4D243D]/10 space-y-4">
                    <p class="font-serif text-3xl font-bold" x-text="formatDateFull(data.event_date)">{{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('l, d F Y') }}</p>
                    <p class="text-[10px] uppercase tracking-widest font-bold" x-text="'Pukul ' + data.data.event.akad_time + ' WIB - SELESAI'">Pukul 09:00 WIB - SELESAI</p>
                </div>

                <div class="pt-10 space-y-6">
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-widest text-[#4D243D]">Alamat Lengkap</h4>
                        <p class="text-sm leading-relaxed mt-2 text-slate-600 italic" x-text="data.event_location">"{{ $invitation->event_location }}"</p>
                    </div>
                    
                    <a :href="data.data.event.google_maps || 'https://maps.google.com'" target="_blank" class="inline-block px-12 py-4 text-white text-[10px] font-bold uppercase tracking-widest rounded-full shadow-2xl bg-[#4D243D]">
                        Buka Google Maps
                    </a>
                </div>
            </div>
        </section>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        function themePreview() {
            return {
                isOpen: true, // Ethereal has no overlay
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
                    AOS.init({ once: true, duration: 1000 });
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
