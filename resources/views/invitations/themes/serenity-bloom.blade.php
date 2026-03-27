<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>{{ $invitation->title ?? 'The Wedding of Romeo & Juliet' }}</title>

    <!-- Essential Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Montserrat:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bloom-lavender: #9D8BB5;
            --bloom-dusty-rose: #C28B91;
            --bloom-sage: #B4C2B4;
            --bloom-white: #FCFBFD;
        }

        body { 
            font-family: 'Montserrat', sans-serif; 
            background-color: var(--bloom-white); 
            color: #4A3E54;
            overflow-x: hidden;
        }

        .font-script { font-family: 'Cormorant Garamond', serif; }
        .font-serif { font-family: 'Playfair Display', serif; }

        /* Cinematic Particles Animation */
        .petal {
            position: fixed;
            background: rgba(157, 139, 181, 0.1);
            border-radius: 100% 0 100% 0;
            pointer-events: none;
            z-index: 50;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% { transform: translateY(-10vh) rotate(0deg); opacity: 0; }
            10% { opacity: 0.8; }
            90% { opacity: 0.5; }
            100% { transform: translateY(110vh) rotate(720deg); opacity: 0; }
        }

        .glass-card {
            background: rgba(252, 251, 253, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .bloom-gradient-text {
            background: linear-gradient(135deg, var(--bloom-lavender), var(--bloom-dusty-rose));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .ring-decor {
            border: 1px solid rgba(157, 139, 181, 0.2);
            border-radius: 50%;
        }
    </style>
</head>
<body x-data="invitationRenderer()" x-init="init()" class="antialiased scroll-smooth">
    
    <!-- Floating Petals Container -->
    <div id="particles-container">
        <template x-for="n in 15">
            <div class="petal" 
                 :style="`width: ${Math.random()*15+5}px; height: ${Math.random()*15+5}px; left: ${Math.random()*100}vw; animation-duration: ${Math.random()*10+10}s; animation-delay: -${Math.random()*20}s;`">
            </div>
        </template>
    </div>

    <!-- 1. Cinematic Gate (Opening) -->
    <section x-show="!isOpen" 
             x-transition:leave="transition ease-in-out duration-1000 transform" 
             x-transition:leave-start="translate-y-0 opacity-100" 
             x-transition:leave-end="-translate-y-full opacity-0"
             class="fixed inset-0 z-[200] flex flex-col items-center justify-center p-8 bg-[#F5F3F7] overflow-hidden">
        
        <!-- Decorative Frame -->
        <div class="absolute inset-10 border border-white/40 ring-1 ring-lavender-200/20 rounded-[5rem]"></div>
        
        <div class="text-center relative z-10" data-aos="zoom-in">
            <span class="text-[10px] font-black uppercase tracking-[0.6em] text-bloom-lavender/50 block mb-6">You're Cordially Invited</span>
            <div class="flex items-center justify-center gap-6 mb-12">
                <div class="w-16 h-[1px] bg-bloom-lavender/20"></div>
                <div class="w-4 h-4 rounded-full border border-bloom-lavender/30"></div>
                <div class="w-16 h-[1px] bg-bloom-lavender/20"></div>
            </div>

            <h1 class="font-serif text-5xl md:text-7xl font-light mb-4">
                <span class="block italic text-slate-400">The Wedding of</span>
                <span class="block mt-4 bloom-gradient-text font-script text-7xl md:text-9xl leading-tight" 
                      x-text="(data.data?.groom?.nickname || 'Romeo') + ' & ' + (data.data?.bride?.nickname || 'Juliet')"></span>
            </h1>

            <div class="mt-20">
                <p class="text-[11px] font-black uppercase tracking-[0.3em] text-slate-400 mb-8" x-text="'Kepada Yth: ' + (decodeURIComponent(new URLSearchParams(window.location.search).get('to') || 'Tamu Undangan'))"></p>
                <button @click="openInvitation()" 
                        class="bg-white px-12 py-5 rounded-full text-[11px] font-black uppercase tracking-[0.5em] text-bloom-lavender shadow-xl hover:scale-105 active:scale-95 transition-all group border border-bloom-lavender/10">
                    <i class="fas fa-envelope-open mr-2 opacity-30 group-hover:opacity-100 transition"></i> Buka Undangan
                </button>
            </div>
        </div>
    </section>

    <!-- 2. Main Content -->
    <div x-show="isOpen" x-cloak>
        
        <!-- Navbar (Floating Premium) -->
        <nav class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[100] preserve-3d">
            <div class="glass-card px-8 py-5 rounded-[2.5rem] shadow-2xl flex items-center gap-10 border-white/60">
                <a href="#hero" class="text-bloom-lavender hover:scale-125 transition"><i class="fas fa-home"></i></a>
                <a href="#couple" class="text-bloom-lavender hover:scale-125 transition"><i class="fas fa-heart"></i></a>
                <a href="#event" class="text-bloom-lavender hover:scale-125 transition"><i class="fas fa-calendar-alt"></i></a>
                <a href="#gallery" class="text-bloom-lavender hover:scale-125 transition"><i class="fas fa-images"></i></a>
                <a href="#rsvp" class="text-bloom-lavender hover:scale-125 transition"><i class="fas fa-comment"></i></a>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="hero" class="min-h-screen relative flex items-center justify-center py-32 overflow-hidden bg-white">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 right-20 w-96 h-96 bg-bloom-lavender blur-[150px] rounded-full"></div>
                <div class="absolute bottom-20 left-20 w-80 h-80 bg-bloom-dusty-rose blur-[150px] rounded-full"></div>
            </div>

            <div class="max-w-4xl mx-auto px-8 text-center relative z-10" data-aos="fade-up">
                <div class="mb-12 inline-block relative">
                    <div class="w-32 h-32 md:w-48 md:h-48 rounded-full border border-bloom-lavender/20 flex items-center justify-center p-4">
                        <div class="w-full h-full rounded-full bg-slate-100 overflow-hidden shadow-2xl">
                             <img :src="data.data?.groom?.photo || 'https://images.unsplash.com/photo-1550009158-9ebf69173e03?q=80&w=2001&auto=format&fit=crop'" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
                <h2 class="font-script text-7xl md:text-9xl text-slate-300 italic mb-4 leading-none" 
                    x-text="data.data?.groom?.nickname || 'Romeo'"></h2>
                <h2 class="font-script text-7xl md:text-9xl text-bloom-lavender -mt-8 mb-10 leading-none" 
                    x-text="data.data?.bride?.nickname || 'Juliet'"></h2>
                
                <div class="w-24 h-[1px] bg-bloom-lavender/30 mx-auto mb-10"></div>
                
                <p class="font-serif italic text-xl tracking-widest text-slate-400" 
                   x-text="formatDate(data.event_date)"></p>
            </div>
        </section>

        <!-- Couple Profile -->
        <section id="couple" class="py-32 bg-[#FAF8FB]">
            <div class="max-w-6xl mx-auto px-8">
                <div class="text-center mb-24" data-aos="fade-up">
                    <h2 class="font-serif text-5xl md:text-6xl mb-6">The Couple</h2>
                    <p class="font-serif italic text-lg opacity-40">"Cinta tidak melihat dengan mata, tetapi dengan hati."</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
                    <!-- Groom -->
                    <div class="text-center md:text-right" data-aos="fade-right">
                        <div class="relative inline-block mb-10">
                             <div class="w-64 h-80 rounded-[4rem] overflow-hidden shadow-2xl border-4 border-white">
                                <img :src="data.data?.groom?.photo || 'https://images.unsplash.com/photo-1550009158-9ebf69173e03?q=80&w=2001&auto=format&fit=crop'" class="w-full h-full object-cover grayscale-[20%] hover:grayscale-0 transition duration-700">
                             </div>
                             <div class="absolute -bottom-6 -right-6 w-24 h-24 glass-card rounded-full flex items-center justify-center border border-white/50 text-bloom-lavender text-4xl">
                                <i class="fas fa-mars"></i>
                             </div>
                        </div>
                        <h3 class="font-script text-6xl text-bloom-lavender mb-2" x-text="data.data?.groom?.nickname"></h3>
                        <p class="text-sm font-black uppercase tracking-[0.3em] text-slate-600 mb-6" x-text="data.data?.groom?.full_name"></p>
                        <p class="text-xs italic text-slate-400 leading-loose" x-text="'Putra dari pasangan ' + (data.data?.groom?.father_name || 'Bpk. Nama Ayah') + ' & ' + (data.data?.groom?.mother_name || 'Ibu Nama Ibu')"></p>
                    </div>

                    <!-- Bride -->
                    <div class="text-center md:text-left" data-aos="fade-left">
                        <div class="relative inline-block mb-10">
                             <div class="w-64 h-80 rounded-[4rem] overflow-hidden shadow-2xl border-4 border-white">
                                <img :src="data.data?.bride?.photo || 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2040&auto=format&fit=crop'" class="w-full h-full object-cover grayscale-[20%] hover:grayscale-0 transition duration-700">
                             </div>
                             <div class="absolute -bottom-6 -left-6 w-24 h-24 glass-card rounded-full flex items-center justify-center border border-white/50 text-bloom-dusty-rose text-4xl">
                                <i class="fas fa-venus"></i>
                             </div>
                        </div>
                        <h3 class="font-script text-6xl text-bloom-dusty-rose mb-2" x-text="data.data?.bride?.nickname"></h3>
                        <p class="text-sm font-black uppercase tracking-[0.3em] text-slate-600 mb-6" x-text="data.data?.bride?.full_name"></p>
                        <p class="text-xs italic text-slate-400 leading-loose" x-text="'Putri dari pasangan ' + (data.data?.bride?.father_name || 'Bpk. Nama Ayah') + ' & ' + (data.data?.bride?.mother_name || 'Ibu Nama Ibu')"></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Event Section -->
        <section id="event" class="py-32 bg-white relative overflow-hidden">
             <!-- Circular Decor -->
             <div class="absolute -top-32 -left-32 w-96 h-96 ring-decor opacity-40"></div>
             <div class="absolute -bottom-32 -right-32 w-[600px] h-[600px] ring-decor opacity-20"></div>

             <div class="max-w-5xl mx-auto px-8 relative z-10 text-center">
                <div class="mb-24" data-aos="fade-up">
                    <span class="text-[10px] font-black uppercase tracking-[0.8em] text-bloom-lavender/50 block mb-6">The Celebration</span>
                    <h2 class="font-serif text-5xl md:text-7xl">Save The Date</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                     <!-- Akad/Nikah -->
                     <div class="glass-card p-12 rounded-[4rem] shadow-xl border-white" data-aos="fade-right">
                        <i class="fas fa-dove text-4xl text-bloom-lavender mb-8 opacity-40"></i>
                        <h3 class="font-serif text-3xl mb-8">Akad Nikah</h3>
                        <div class="space-y-6">
                            <div>
                                <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-2">Tanggal & Waktu</p>
                                <p class="text-sm font-bold text-slate-700" x-text="formatDate(data.event_date) + ' | 08:00 - 10:00 WIB'"></p>
                            </div>
                            <div class="w-12 h-[1px] bg-bloom-lavender/20 mx-auto"></div>
                            <div>
                                <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-2">Lokasi Acara</p>
                                <p class="text-sm font-bold text-slate-700 leading-relaxed" x-text="data.event_location"></p>
                            </div>
                        </div>
                     </div>

                     <!-- Resepsi -->
                     <div class="glass-card p-12 rounded-[4rem] shadow-xl border-white" data-aos="fade-left">
                        <i class="fas fa-glass-cheers text-4xl text-bloom-dusty-rose mb-8 opacity-40"></i>
                        <h3 class="font-serif text-3xl mb-8">Resepsi</h3>
                        <div class="space-y-6">
                            <div>
                                <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-2">Tanggal & Waktu</p>
                                <p class="text-sm font-bold text-slate-700" x-text="formatDate(data.event_date) + ' | 11:00 - Selesai'"></p>
                            </div>
                            <div class="w-12 h-[1px] bg-bloom-lavender/20 mx-auto"></div>
                            <div>
                                <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-2">Lokasi Acara</p>
                                <p class="text-sm font-bold text-slate-700 leading-relaxed" x-text="data.event_location"></p>
                            </div>
                        </div>
                     </div>
                </div>

                <button class="mt-20 bg-bloom-lavender text-white px-12 py-5 rounded-full text-[10px] font-black uppercase tracking-[0.4em] shadow-2xl hover:scale-105 active:scale-95 transition-all">
                    <i class="fas fa-map-marker-alt mr-2"></i> Buka Google Maps
                </button>
             </div>
        </section>

        <!-- Gallery Architect -->
        <section id="gallery" class="py-32 bg-[#FAF8FB]">
            <div class="max-w-7xl mx-auto px-8">
                <div class="text-center mb-24" data-aos="fade-up">
                    <h2 class="font-serif text-5xl md:text-7xl mb-6">Moments</h2>
                    <p class="font-serif italic text-lg opacity-40">Kenangan indah langkah awal perjalanan kami</p>
                </div>

                <!-- Masonry Layout -->
                <div x-show="!data.data?.gallery_style || data.data?.gallery_style === 'masonry'" 
                     class="columns-1 sm:columns-2 lg:columns-3 gap-8 space-y-8">
                    <template x-for="(img, index) in (data.data?.gallery || [])" :key="index">
                        <div class="break-inside-avoid rounded-3xl overflow-hidden shadow-xl border-white border-4" data-aos="zoom-in">
                            <img :src="img" class="w-full h-auto object-cover hover:scale-110 transition duration-1000">
                        </div>
                    </template>
                </div>

                <!-- Uniform Grid Layout -->
                <div x-show="data.data?.gallery_style === 'grid'" 
                     class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <template x-for="(img, index) in (data.data?.gallery || [])" :key="index">
                        <div class="aspect-square rounded-2xl overflow-hidden shadow-lg border-2 border-white" data-aos="zoom-in" :data-aos-delay="index * 50">
                            <img :src="img" class="w-full h-full object-cover">
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <!-- Digital Gift -->
        <section id="gift" class="py-32 bg-white text-center" x-show="data.data?.general?.show_gift">
             <div class="max-w-2xl mx-auto px-8">
                <div class="mb-20" data-aos="fade-up">
                    <h2 class="font-serif text-5xl md:text-6xl mb-6">Wedding Gift</h2>
                    <p class="font-serif italic text-sm opacity-40 leading-relaxed">Tanpa mengurangi rasa hormat, bagi Anda yang ingin memberikan tanda kasih untuk kami dapat melalui:</p>
                </div>

                <div class="space-y-8">
                    <template x-for="(item, index) in (data.data?.gifts || [])" :key="index">
                        <div class="glass-card p-10 rounded-[3rem] shadow-xl border-white" data-aos="zoom-in" :data-aos-delay="index * 100">
                            <i class="fas fa-credit-card text-3xl text-bloom-lavender/30 mb-8"></i>
                            <p class="text-[10px] font-black uppercase tracking-[0.5em] text-slate-400 mb-4" x-text="item.bank_name"></p>
                            <h4 class="text-3xl md:text-4xl font-black text-slate-800 tracking-widest mb-4" x-text="item.account_number"></h4>
                            <p class="text-xs font-bold uppercase tracking-widest text-bloom-lavender mb-8" x-text="'a/n ' + item.account_holder"></p>
                            <button @click="navigator.clipboard.writeText(item.account_number); alert('No. Rekening disalin!')" 
                                    class="bg-bloom-lavender text-white px-10 py-4 rounded-full text-[10px] font-black uppercase tracking-widest shadow-xl hover:bg-slate-800 transition">
                                Salin Nomor
                            </button>
                        </div>
                    </template>
                </div>
             </div>
        </section>

        <!-- RSVP & Guestbook -->
        <section id="rsvp" class="py-32 bg-[#F5F3F7]">
            <div class="max-w-4xl mx-auto px-8">
                <div class="text-center mb-24" data-aos="fade-up">
                    <h2 class="font-serif text-5xl md:text-7xl mb-6">Words of Love</h2>
                    <p class="font-serif italic text-lg opacity-40">Sempurnakan kebahagiaan kami dengan doa & ucapan Anda</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
                     <!-- Form -->
                    <div class="glass-card p-10 rounded-[3rem] shadow-xl border-white" data-aos="fade-right">
                        <form action="{{ route('invitations.message', $invitation) }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label class="block text-[8px] font-black uppercase tracking-widest opacity-40 mb-3">Nama Anda</label>
                                <input type="text" name="name" required class="w-full bg-white/50 border-white/20 rounded-2xl px-6 py-4 text-sm focus:ring-bloom-lavender/20">
                            </div>
                            <div>
                                <label class="block text-[8px] font-black uppercase tracking-widest opacity-40 mb-3">Kehadiran</label>
                                <select name="is_attending" class="w-full bg-white/50 border-white/20 rounded-2xl px-6 py-4 text-sm focus:ring-bloom-lavender/20">
                                    <option value="1">Akan Hadir</option>
                                    <option value="0">Maaf, Berhalangan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[8px] font-black uppercase tracking-widest opacity-40 mb-3">Pesan & Doa</label>
                                <textarea name="message" required rows="4" class="w-full bg-white/50 border-white/20 rounded-2xl px-6 py-4 text-sm focus:ring-bloom-lavender/20"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-bloom-lavender text-white py-5 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-2xl hover:scale-105 active:scale-95 transition-all">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>

                    <!-- Messages Feed -->
                    <div class="space-y-6 max-h-[600px] overflow-y-auto pr-4 custom-scrollbar" data-aos="fade-left">
                        @foreach ($messages as $msg)
                            <div class="bg-white/40 p-8 rounded-[2.5rem] border border-white/60 shadow-sm relative overflow-hidden backdrop-blur-sm">
                                <div class="absolute top-0 right-0 w-16 h-16 bg-bloom-lavender/5 rounded-bl-full flex items-center justify-center p-4">
                                    <i class="fas fa-quote-right text-xs text-bloom-lavender/20"></i>
                                </div>
                                <h5 class="text-bloom-lavender font-bold text-sm mb-2">{{ $msg->name }}</h5>
                                <p class="text-xs text-slate-500 leading-relaxed italic">"{{ $msg->message }}"</p>
                                <span class="text-[8px] font-black uppercase tracking-widest opacity-30 mt-6 block">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-24 bg-white text-center relative overflow-hidden">
             <div class="absolute inset-0 bg-gradient-to-t from-[#F5F3F7] to-transparent"></div>
             <div class="relative z-10 flex flex-col items-center">
                <div class="w-16 h-16 bg-bloom-lavender rounded-3xl flex items-center justify-center text-white mb-10 shadow-2xl rotate-12">
                    <span class="font-serif text-3xl font-bold italic">A</span>
                </div>
                <h4 class="font-serif text-3xl text-slate-400 italic mb-4">See You There!</h4>
                <p class="text-[10px] font-black uppercase tracking-[0.5em] text-slate-300">Amora Premium Studio 2026</p>
             </div>
        </footer>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        function invitationRenderer() {
            return {
                isOpen: false,
                data: @json($invitation),
                
                init() {
                    AOS.init({ duration: 1200, once: true });
                    
                    window.addEventListener('message', (event) => {
                        if (event.data.type === 'UPDATE_DATA') {
                            this.data = event.data.data;
                            if (window.AOS) {
                                window.AOS.refresh();
                            }
                        }
                    });
                },

                openInvitation() {
                    this.isOpen = true;
                    // Start Music or other events
                    setTimeout(() => { if(window.AOS) window.AOS.refresh(); }, 500);
                },

                formatDate(dateStr) {
                    if(!dateStr) return 'TBA';
                    const date = new Date(dateStr);
                    return date.toLocaleDateString('id-ID', {
                        weekday: 'long', 
                        day: 'numeric', 
                        month: 'long', 
                        year: 'numeric'
                    });
                }
            }
        }
    </script>
</body>
</html>
