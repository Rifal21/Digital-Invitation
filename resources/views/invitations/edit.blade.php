<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Undangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <form action="{{ route('invitations.update', $invitation->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 font-semibold mb-1">Judul Undangan</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $invitation->title) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="groom_name" class="block text-sm font-medium text-gray-700 font-semibold mb-1">Nama Mempelai Pria</label>
                            <input type="text" name="groom_name" id="groom_name" value="{{ old('groom_name', $invitation->groom_name) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                            @error('groom_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="bride_name" class="block text-sm font-medium text-gray-700 font-semibold mb-1">Nama Mempelai Wanita</label>
                            <input type="text" name="bride_name" id="bride_name" value="{{ old('bride_name', $invitation->bride_name) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                            @error('bride_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="event_date" class="block text-sm font-medium text-gray-700 font-semibold mb-1">Tanggal Acara</label>
                            <input type="date" name="event_date" id="event_date" value="{{ old('event_date', $invitation->event_date) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                            @error('event_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700 font-semibold mb-1">URL Unik (Slug)</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $invitation->slug) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                            @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="event_location" class="block text-sm font-medium text-gray-700 font-semibold mb-1">Lokasi Acara</label>
                        <textarea name="event_location" id="event_location" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">{{ old('event_location', $invitation->event_location) }}</textarea>
                        @error('event_location') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 font-semibold mb-1">Pesan / Doa Restu (Opsional)</label>
                        <textarea name="message" id="message" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">{{ old('message', $invitation->message) }}</textarea>
                        @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="theme_color" class="block text-sm font-medium text-gray-700 font-semibold mb-1">Pilih Warna Aksen</label>
                            <input type="color" name="theme_color" id="theme_color" value="{{ old('theme_color', $invitation->theme_color) }}" class="h-10 w-full border-gray-300 rounded-md shadow-sm cursor-pointer p-1">
                            @error('theme_color') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="theme" class="block text-sm font-medium text-gray-700 font-semibold mb-1">Pilih Template</label>
                            <select name="theme" id="theme" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                                @foreach($themes as $theme)
                                    <option value="{{ $theme->slug }}" {{ old('theme', $invitation->theme) == $theme->slug ? 'selected' : '' }}>
                                        {{ $theme->name }} ({{ $theme->tag }})
                                    </option>
                                @endforeach
                            </select>
                            @error('theme') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 border-t pt-6">
                        <div>
                            <label for="hero_image" class="block text-sm font-medium text-gray-700 font-semibold mb-1">Ganti Hero Image</label>
                            <input type="file" name="hero_image" id="hero_image" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 italic">
                            @if($invitation->hero_image) <p class="mt-1 text-[10px] text-green-600 font-bold tracking-tighter uppercase">Sudah terpasang</p> @endif
                        </div>
                        <div>
                            <label for="background_image" class="block text-sm font-medium text-gray-700 font-semibold mb-1">Ganti Background</label>
                            <input type="file" name="background_image" id="background_image" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 italic">
                             @if($invitation->background_image) <p class="mt-1 text-[10px] text-green-600 font-bold tracking-tighter uppercase">Sudah terpasang</p> @endif
                        </div>
                    </div>

                    <div class="pt-6 border-t flex justify-end gap-3">
                        <a href="{{ route('invitations.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md shadow-sm hover:bg-gray-50 uppercase text-[10px] font-bold transition tracking-widest">Batal</a>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 uppercase text-[10px] font-bold transition tracking-widest">Update Undangan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
