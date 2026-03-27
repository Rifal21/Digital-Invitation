<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Ubah Paket: ') }} <span class="text-indigo-600 italic">{{ $package->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-[2.5rem] border border-slate-100">
                <div class="p-10 md:p-14 text-gray-900">
                    <form method="POST" action="{{ route('admin.packages.update', $package) }}" class="space-y-10">
                        @csrf
                        @method('PUT')

                        <!-- Nama Paket -->
                        <div>
                            <x-input-label for="name" :value="__('Nama Paket')" class="text-[10px] font-black uppercase tracking-[0.2em] mb-4 text-slate-400" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full py-4 text-lg font-bold border-slate-100 italic" :value="old('name', $package->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- Harga -->
                        <div>
                            <x-input-label for="price" :value="__('Harga (Rp)')" class="text-[10px] font-black uppercase tracking-[0.2em] mb-4 text-slate-400" />
                            <x-text-input id="price" name="price" type="number" class="mt-1 block w-full py-4 text-lg font-bold border-slate-100 italic" :value="old('price', $package->price)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <x-input-label for="description" :value="__('Deskripsi Pendek')" class="text-[10px] font-black uppercase tracking-[0.2em] mb-4 text-slate-400" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-slate-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl shadow-sm text-sm p-4 h-32 italic">{{ old('description', $package->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <!-- Fitur Dynamically -->
                        <div x-data="{ features: {{ json_encode($package->features) }} }">
                            <div class="flex justify-between items-center mb-6">
                                <x-input-label :value="__('Daftar Fitur Paket')" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400" />
                                <button type="button" @click="features.push('')" class="text-[9px] font-black text-indigo-600 uppercase tracking-widest bg-indigo-50 px-4 py-2 rounded-full hover:bg-indigo-100 transition shadow-sm">
                                    Tambah Fitur
                                </button>
                            </div>
                            
                            <div class="space-y-4">
                                <template x-for="(feature, index) in features" :key="index">
                                    <div class="flex gap-4 items-center">
                                        <div class="flex-grow">
                                            <input type="text" name="features[]" x-model="features[index]" class="w-full border-slate-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl shadow-sm text-sm p-4 italic" required>
                                        </div>
                                        <button type="button" @click="features.splice(index, 1)" class="w-10 h-10 flex items-center justify-center text-rose-300 hover:text-rose-500 transition border border-rose-50 rounded-full bg-rose-50/20" x-show="features.length > 1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v2m3 3h7"></path></svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="flex items-center justify-end pt-10 border-t border-slate-50 gap-6">
                            <a href="{{ route('admin.packages.index') }}" class="text-[10px] font-bold uppercase tracking-widest text-slate-400 hover:text-slate-600 transition">Batal</a>
                            <button type="submit" class="px-12 py-5 bg-indigo-600 text-white rounded-2xl font-black text-sm uppercase tracking-[0.3em] shadow-2xl hover:bg-slate-900 transition duration-500 active:scale-95">
                                Perbarui Paket
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
