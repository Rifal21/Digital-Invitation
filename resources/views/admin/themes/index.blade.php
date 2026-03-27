<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Tema Undangan') }}
            </h2>
            <a href="{{ route('admin.themes.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-xs font-bold uppercase tracking-widest hover:bg-indigo-700 transition">
                + Tambah Tema Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($themes as $theme)
                            <div class="border rounded-xl p-6 relative group overflow-hidden">
                                <!-- Background Indicator -->
                                <div class="absolute top-0 right-0 w-16 h-16 opacity-10 -mr-4 -mt-4 rounded-full" style="background-color: {{ $theme->color }}"></div>
                                
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <span class="text-[10px] font-bold uppercase tracking-widest px-2 py-0.5 rounded {{ $theme->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $theme->is_active ? 'Aktif' : 'Non-Aktif' }}
                                        </span>
                                        <h3 class="text-lg font-bold mt-2">{{ $theme->name }}</h3>
                                    </div>
                                    <div class="w-8 h-8 rounded-full border-2 border-white shadow-sm" style="background-color: {{ $theme->color }}"></div>
                                </div>

                                <p class="text-sm text-gray-500 mb-6 line-clamp-2 italic">"{{ $theme->description }}"</p>
                                
                                <div class="flex items-center gap-3 text-xs text-gray-400 mb-6">
                                    <span class="font-mono">Slug: {{ $theme->slug }}</span>
                                    <span>•</span>
                                    <span class="font-bold text-indigo-600 uppercase tracking-tighter">{{ $theme->tag }}</span>
                                </div>

                                <div class="flex justify-between items-center pt-6 border-t">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.themes.edit', $theme->id) }}" class="p-2 text-gray-400 hover:text-indigo-600 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.themes.destroy', $theme->id) }}" method="POST" onsubmit="return confirm('Hapus tema ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                    <a href="{{ route('themes.preview', $theme->slug) }}" target="_blank" class="text-[10px] font-bold uppercase tracking-widest text-[#4D243D] hover:underline">
                                        Pratinjau Live →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
