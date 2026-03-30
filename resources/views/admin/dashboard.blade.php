<x-app-layout>
    <x-slot name="header">
        Dashboard Executive
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Insight Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="bg-white p-10 rounded-[2.5rem] shadow-[0_20px_40px_rgba(0,0,0,0.02)] border border-slate-50 relative overflow-hidden group hover:shadow-2xl transition duration-700 hover:-translate-y-1">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-50/50 rounded-full blur-2xl group-hover:bg-indigo-100 transition duration-700"></div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mb-4">Market Share</p>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-6xl font-serif font-black text-[#0F172A] tracking-tighter">{{ $stats['users'] }}</h3>
                        <span class="text-slate-400 font-bold italic">Total Pengguna</span>
                    </div>
                </div>
                
                <div class="bg-white p-10 rounded-[2.5rem] shadow-[0_20px_40px_rgba(0,0,0,0.02)] border border-slate-50 relative overflow-hidden group hover:shadow-2xl transition duration-700 hover:-translate-y-1">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-emerald-50/50 rounded-full blur-2xl group-hover:bg-emerald-100 transition duration-700"></div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mb-4">Total Production</p>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-6xl font-serif font-black text-[#0F172A] tracking-tighter">{{ $stats['invitations'] }}</h3>
                        <span class="text-slate-400 font-bold italic">Undangan Terbit</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Table Section -->
            <div class="bg-white rounded-[2.5rem] shadow-[0_30px_60px_rgba(0,0,0,0.02)] border border-slate-50 overflow-hidden">
                <div class="p-10 md:p-14 text-gray-900">
                    <div class="flex justify-between items-end mb-10 pb-6 border-b border-slate-50">
                        <div>
                            <span class="text-[9px] font-black text-indigo-500 uppercase tracking-[0.6em] mb-2 block">Real-time Stream</span>
                            <h4 class="text-3xl font-serif font-black text-[#0F172A]">Undangan Terbaru</h4>
                        </div>
                        <a href="{{ route('admin.invitations.index') }}" class="text-[10px] font-black text-[#0F172A]/40 uppercase tracking-widest hover:text-[#0F172A] transition border-b-2 border-transparent hover:border-[#0F172A]/20 pb-1">Review All Records →</a>
                    </div>
                    
                    <div class="overflow-x-auto">
                         <table class="w-full text-left">
                            <thead>
                                <tr class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">
                                    <th class="px-6 py-6">Identity / Judul</th>
                                    <th class="px-6 py-6 font-medium">Author</th>
                                    <th class="px-6 py-6 font-medium">Design System</th>
                                    <th class="px-6 py-6 font-medium">Created At</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($latest_invitations as $inv)
                                    <tr class="group hover:bg-slate-50/50 transition duration-300">
                                        <td class="px-6 py-8 text-sm font-bold text-[#0F172A] italic tracking-tight">{{ $inv->title }}</td>
                                        <td class="px-6 py-8 text-xs font-medium text-slate-600 uppercase tracking-widest">{{ $inv->user->name }}</td>
                                        <td class="px-6 py-8">
                                            <span class="px-4 py-1.5 rounded-full bg-slate-100 text-[#0F172A]/60 text-[9px] font-black uppercase tracking-widest group-hover:bg-white group-hover:shadow-sm transition duration-500">{{ $inv->theme ?? 'Default' }}</span>
                                        </td>
                                        <td class="px-6 py-8 text-xs text-slate-400 font-bold uppercase tracking-widest">{{ $inv->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                         </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
