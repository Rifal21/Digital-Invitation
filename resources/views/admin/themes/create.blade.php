<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Tema Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl p-8">
                <form action="{{ route('admin.themes.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <label for="name" class="block text-sm font-medium text-gray-700 font-bold mb-1 italic">Nama Tema</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Contoh: Modern Vintage" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label for="slug" class="block text-sm font-medium text-gray-700 font-bold mb-1 italic">Slug (Blade Name)</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="modern-vintage" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                             <p class="mt-1 text-[10px] text-gray-400">Harus sesuai dengan nama file .blade.php</p>
                            @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 font-bold mb-1 italic">Deskripsi Singkat</label>
                        <textarea name="description" id="description" rows="2" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">{{ old('description') }}</textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                             <label for="tag" class="block text-sm font-medium text-gray-700 font-bold mb-1 italic">Label Tag</label>
                             <select name="tag" id="tag" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                                <option value="Gratis">Gratis</option>
                                <option value="Premium">Premium</option>
                                <option value="Premium+">Premium+</option>
                                <option value="Exclusive">Exclusive</option>
                             </select>
                             @error('tag') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="color" class="block text-sm font-medium text-gray-700 font-bold mb-1 italic">Aksen Warna Utama</label>
                            <input type="color" name="color" id="color" value="{{ old('color', '#4D243D') }}" class="h-10 w-full border-gray-300 rounded-md shadow-sm cursor-pointer p-1">
                            @error('color') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked class="rounded-sm border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="is_active" class="text-sm font-medium text-gray-700 font-bold mb-1 italic">Aktifkan Tema Ini</label>
                    </div>

                    <div class="pt-6 border-t flex justify-end gap-3">
                        <a href="{{ route('admin.themes.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md shadow-sm hover:bg-gray-50 uppercase text-[10px] font-bold transition tracking-widest">Batal</a>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 uppercase text-[10px] font-bold transition tracking-widest">Tambah Tema</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
