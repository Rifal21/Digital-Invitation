<x-app-layout>
    <x-slot name="header">
        Manajemen Pembayaran
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-10">
                <div>
                     <span class="text-[9px] font-black text-indigo-500 uppercase tracking-[0.6em] mb-2 block">Payment Backend</span>
                     <h4 class="text-4xl font-serif font-black text-[#4D243D]">Metode Pembayaran</h4>
                </div>
                <button @click="window.location.href='{{ route('admin.payment-methods.create') }}'" class="px-8 py-4 bg-[#4D243D] text-[#EDD4B2] rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-2xl hover:bg-slate-900 transition duration-500 active:scale-95">
                    Tambah Provider
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($methods as $method)
                    <div class="bg-white rounded-[2.5rem] p-10 shadow-[0_30px_60px_rgba(0,0,0,0.02)] border border-slate-50 relative group transition hover:-translate-y-2">
                        <!-- Status Toggle Button -->
                         <form method="POST" action="{{ route('admin.payment-methods.toggle', $method) }}" class="absolute top-8 right-8">
                             @csrf
                             @method('PATCH')
                             <button class="w-10 h-10 rounded-xl flex items-center justify-center transition {{ $method->is_active ? 'bg-emerald-50 text-emerald-500' : 'bg-rose-50 text-rose-300' }}">
                                 <i class="fas {{ $method->is_active ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                             </button>
                         </form>

                        <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-[#4D243D] mb-8 border border-slate-100 group-hover:rotate-12 transition shadow-sm">
                             @if($method->qr_image)
                                 <i class="fas fa-qrcode text-2xl text-rose-500"></i>
                             @else
                                 <i class="fas fa-university text-2xl text-slate-400"></i>
                             @endif
                        </div>

                        <h3 class="text-2xl font-serif font-black text-[#4D243D] mb-4 italic">{{ $method->name }}</h3>
                        
                        <div class="space-y-4 mb-10">
                            <div>
                                <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest mb-1">Account Number</p>
                                <p class="text-lg font-black text-[#4D243D] tracking-tighter">{{ $method->account_number }}</p>
                            </div>
                            <div>
                                <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest mb-1">Account Holder</p>
                                <p class="text-xs font-bold text-slate-600 italic uppercase">{{ $method->account_name }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-8 border-t border-slate-50">
                            <a href="{{ route('admin.payment-methods.edit', $method) }}" class="text-[9px] font-black uppercase tracking-widest text-[#4D243D]/40 hover:text-[#4D243D] transition">Sunting</a>
                            <form method="POST" action="{{ route('admin.payment-methods.destroy', $method) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-[9px] font-black uppercase tracking-widest text-rose-300 hover:text-rose-500 transition" onclick="return confirm('Hapus provider ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
