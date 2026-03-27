<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Semua Undangan') }}
        </h2>
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
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b">
                                <tr class="text-xs font-bold uppercase tracking-widest text-gray-400">
                                    <th class="px-6 py-4">Sutuju / Judul</th>
                                    <th class="px-6 py-4">Pemilik</th>
                                    <th class="px-6 py-4">Tipe Tema</th>
                                    <th class="px-6 py-4">Status / Dibuat</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y text-sm">
                                @forelse($invitations as $inv)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-gray-900">{{ $inv->title }}</div>
                                            <div class="text-xs text-gray-400">Slug: /{{ $inv->slug }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-medium text-gray-900">{{ $inv->user->name }}</div>
                                            <div class="text-xs text-gray-400">{{ $inv->user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-tighter bg-indigo-50 text-indigo-700 border border-indigo-100">
                                                {{ $inv->theme ?? 'Modern' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-gray-500 uppercase tracking-tighter text-xs">
                                                {{ $inv->created_at->translatedFormat('d F Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end gap-3">
                                                 <a href="{{ route('invitations.show', $inv) }}" target="_blank" class="p-2 text-gray-400 hover:text-indigo-600 transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                 </a>
                                                 <form action="{{ route('admin.invitations.destroy', $inv) }}" method="POST">
                                                     @csrf
                                                     @method('DELETE')
                                                     <button type="submit" onclick="confirmAction(event, 'Admin: Hapus Undangan?')" class="p-2 text-gray-400 hover:text-red-600 transition">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                     </button>
                                                 </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                            Belum ada undangan yang dibuat oleh user manapun.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        {{ $invitations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
