<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Undangan Digital Saya') }}
            </h2>
            <a href="{{ route('invitations.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                + Buat Undangan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if($invitations->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada undangan</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai buat undangan digital pertama Anda hari ini.</p>
                        <div class="mt-6">
                            <a href="{{ route('invitations.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Buat Undangan
                            </a>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($invitations as $invitation)
                            <div class="border rounded-xl overflow-hidden shadow-sm hover:shadow-md transition bg-gray-50">
                                <div class="h-3 bg-indigo-500" style="background-color: {{ $invitation->theme_color }}"></div>
                                <div class="p-5">
                                    <h4 class="font-bold text-lg text-gray-800 mb-1">{{ $invitation->title }}</h4>
                                    <p class="text-sm text-gray-600 mb-4">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</p>
                                    <div class="text-xs text-gray-500 mb-4 space-y-1">
                                        <p>📅 {{ \Carbon\Carbon::parse($invitation->event_date)->format('d M Y') }}</p>
                                        <p>🔗 /undangan/{{ $invitation->slug }}</p>
                                        <div class="mt-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 uppercase tracking-tighter">
                                            Template: {{ $invitation->theme ?? 'Modern' }}
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('invitations.show', $invitation) }}" target="_blank" class="flex-1 text-center py-2 px-3 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                            Lihat
                                        </a>
                                        <a href="{{ route('invitations.edit', $invitation) }}" class="flex-1 text-center py-2 px-3 bg-indigo-50 border border-transparent rounded-md text-sm font-medium text-indigo-700 hover:bg-indigo-100">
                                            Edit
                                        </a>
                                        <form action="{{ route('invitations.destroy', $invitation) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" @click="confirmAction(event, 'Hapus Undangan Ini?')" class="p-2 text-red-600 hover:bg-red-50 rounded-md">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
