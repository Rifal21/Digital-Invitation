<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('Manajemen Paket Undangan') }}
            </h2>
            <a href="{{ route('admin.packages.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-slate-900 focus:bg-slate-900 active:bg-slate-900 outline-none transition duration-500 shadow-lg">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Paket Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-[2.5rem] border border-slate-100">
                <div class="p-8 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] border-b border-slate-50">
                                    <th class="px-6 py-6">Nama Paket</th>
                                    <th class="px-6 py-6">Harga</th>
                                    <th class="px-6 py-6">Fitur</th>
                                    <th class="px-6 py-6 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($packages as $package)
                                    <tr class="group hover:bg-slate-50 transition duration-300">
                                        <td class="px-6 py-6 font-bold text-slate-900 italic text-lg">{{ $package->name }}</td>
                                        <td class="px-6 py-6">
                                            <span class="text-indigo-600 font-extrabold tracking-tight">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="px-6 py-6">
                                            <div class="flex flex-wrap gap-2">
                                                @foreach ($package->features as $feature)
                                                    <span class="text-[9px] font-bold bg-slate-100 px-3 py-1 rounded-full uppercase tracking-widest text-slate-500">{{ $feature }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-6 text-right">
                                            <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <a href="{{ route('admin.packages.edit', $package) }}" class="text-indigo-600 font-black text-[10px] uppercase tracking-widest hover:text-indigo-800 underline underline-offset-4 decoration-indigo-200">Ubah</a>
                                                <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-rose-500 font-black text-[10px] uppercase tracking-widest hover:text-rose-700 underline underline-offset-4 decoration-rose-200">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-10 text-center italic text-slate-400">Belum ada paket yang tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
