<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Memora - Undangan Cantik</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,400&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Montserrat', sans-serif; }
            .font-serif { font-family: 'Cormorant Garamond', serif; }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="font-sans text-[#0F172A] antialiased bg-[#FDFCFB]">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/" class="flex flex-col items-center gap-6 group">
                <div class="w-20 h-20 bg-[#0F172A] rounded-full flex items-center justify-center text-[#C5A267] shadow-[0_20px_50px_rgba(77,36,61,0.3)] group-hover:scale-110 transition-all duration-500">
                    <span class="font-serif text-4xl font-bold italic">M</span>
                </div>
                <span class="text-4xl font-serif font-bold tracking-[0.3em] uppercase text-[#0F172A]">Memora</span>
            </a>
        </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
