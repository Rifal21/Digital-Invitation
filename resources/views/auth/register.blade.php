<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="font-serif text-3xl font-bold tracking-widest uppercase text-[#0F172A]">Daftar Akun Memora</h2>
        <p class="text-[10px] text-gray-500 mt-2 uppercase tracking-[0.2em] font-medium">Mulai Perjalanan Kisah Cinta Anda Sekarang</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-[10px] font-bold uppercase tracking-[0.2em] text-[#0F172A] mb-2">Nama Lengkap</label>
            <x-text-input id="name" class="block mt-1 w-full bg-slate-50 border-gray-200 focus:border-[#0F172A] focus:ring-[#0F172A] rounded-xl text-sm p-3" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="block text-[10px] font-bold uppercase tracking-[0.2em] text-[#0F172A] mb-2">Alamat Email</label>
            <x-text-input id="email" class="block mt-1 w-full bg-slate-50 border-gray-200 focus:border-[#0F172A] focus:ring-[#0F172A] rounded-xl text-sm p-3" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-[10px] font-bold uppercase tracking-[0.2em] text-[#0F172A] mb-2">Kata Sandi</label>
            <x-text-input id="password" class="block mt-1 w-full bg-slate-50 border-gray-200 focus:border-[#0F172A] focus:ring-[#0F172A] rounded-xl text-sm p-3"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block text-[10px] font-bold uppercase tracking-[0.2em] text-[#0F172A] mb-2">Konfirmasi Kata Sandi</label>
            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-slate-50 border-gray-200 focus:border-[#0F172A] focus:ring-[#0F172A] rounded-xl text-sm p-3"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-500" />
        </div>

        <div class="flex flex-col gap-4 mt-8">
            <x-primary-button class="w-full justify-center bg-[#0F172A] hover:bg-slate-800 text-[#C5A267] py-4 rounded-xl font-bold uppercase tracking-[0.3em] text-[10px] shadow-2xl transition-all">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
            
            <p class="text-center text-[10px] font-bold uppercase tracking-widest text-gray-400 mt-4">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-[#0F172A] hover:underline transition ml-1">Masuk ke Memora</a>
            </p>
        </div>
    </form>
</x-guest-layout>
