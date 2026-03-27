<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-10 text-center">
        <h2 class="font-serif text-3xl font-bold tracking-widest uppercase text-[#4D243D]">Masuk ke Amora</h2>
        <p class="text-xs text-gray-500 mt-2 uppercase tracking-[0.2em] font-medium">Lanjutkan Kisah Kebahagiaan Anda</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-bold uppercase tracking-[0.2em] text-[#4D243D] mb-2">Alamat Email</label>
            <x-text-input id="email" class="block mt-1 w-full bg-slate-50 border-gray-200 focus:border-[#4D243D] focus:ring-[#4D243D] rounded-xl text-sm p-3" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-[10px] font-bold uppercase tracking-[0.2em] text-[#4D243D] mb-2">Kata Sandi</label>
            <x-text-input id="password" class="block mt-1 w-full bg-slate-50 border-gray-200 focus:border-[#4D243D] focus:ring-[#4D243D] rounded-xl text-sm p-3"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#4D243D] shadow-sm focus:ring-[#4D243D]" name="remember">
                <span class="ms-2 text-[10px] font-bold uppercase tracking-widest text-gray-500">{{ __('Ingat saya') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-[#4D243D] transition" href="{{ route('password.request') }}">
                    {{ __('Lupa kata sandi?') }}
                </a>
            @endif
        </div>

        <div class="flex flex-col gap-4 mt-8">
            <x-primary-button class="w-full justify-center bg-[#4D243D] hover:bg-slate-800 text-[#EDD4B2] py-4 rounded-xl font-bold uppercase tracking-[0.3em] text-[10px] shadow-2xl transition-all">
                {{ __('Masuk Sekarang') }}
            </x-primary-button>
            
            <p class="text-center text-[10px] font-bold uppercase tracking-widest text-gray-400 mt-4">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-[#4D243D] hover:underline transition ml-1">Daftar Amora</a>
            </p>
        </div>
    </form>
</x-guest-layout>
