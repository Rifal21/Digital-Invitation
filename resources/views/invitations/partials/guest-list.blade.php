@forelse($invitation->getGuests as $guest)
    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-md group hover:border-[#C5A267]/40 transition duration-700 relative overflow-hidden"
        data-aos="fade-up">
        <div
            class="absolute top-0 right-0 w-24 h-24 bg-slate-50 rounded-full -mr-12 -mt-12 opacity-50 group-hover:bg-[#C5A267]/10 transition duration-700">
        </div>

        <div class="relative z-10">
            <div class="flex justify-between items-start mb-8">
                <div
                    class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-[#0F172A] group-hover:bg-[#0F172A] group-hover:text-[#C5A267] transition duration-500">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="flex gap-2">
                    <button @click="editGuest = {{ json_encode($guest) }}; showEditModal = true" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:bg-[#C5A267] hover:text-[#0F172A] transition-all duration-500">
                        <i class="fas fa-edit text-[10px]"></i>
                    </button>
                    <form action="{{ route('guests.destroy', $guest) }}" method="POST"
                        onsubmit="return confirm('Hapus tamu ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 text-red-300 hover:bg-red-500 hover:text-white transition-all duration-500">
                            <i class="fas fa-trash-alt text-[10px]"></i>
                        </button>
                    </form>
                </div>
            </div>

            <h4 class="font-bold text-xl text-[#0F172A] mb-1 group-hover:text-[#C5A267] transition">
                {{ $guest->name }}</h4>
            <div class="flex flex-wrap gap-2 mb-6">
                <span
                    class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-full text-[8px] font-black uppercase tracking-widest text-slate-400">{{ $guest->group ?? 'Umum' }}</span>
                @if ($guest->phone)
                    <span
                        class="px-3 py-1 bg-emerald-50/50 border border-emerald-100 rounded-full text-[8px] font-black uppercase tracking-widest text-emerald-600">
                        <i class="fas fa-phone-alt mr-1"></i> {{ $guest->phone }}
                    </span>
                @endif
            </div>

            <div class="pt-6 border-t border-slate-50 space-y-4">
                <div class="flex flex-col gap-2">
                    <span class="text-[9px] font-black uppercase tracking-widest text-slate-300">Link
                        Personalisasi:</span>
                    <div class="flex items-center gap-2">
                        <input type="text" readonly
                            value="{{ route('invitations.show', $invitation->slug) }}?to={{ urlencode($guest->name) }}"
                            class="flex-1 bg-slate-50 border-none rounded-lg text-[9px] text-slate-400 py-2 px-3">
                        <button
                            @click="navigator.clipboard.writeText('{{ route('invitations.show', $invitation->slug) }}?to={{ urlencode($guest->name) }}'); Toast.fire({ icon: 'success', title: 'Link disalin!' })"
                            class="w-8 h-8 flex items-center justify-center bg-[#C5A267] text-[#0F172A] rounded-lg text-[10px]">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
                <div class="flex gap-2">
                    @if ($guest->phone)
                        @php
                            $phone = preg_replace('/[^0-9]/', '', $guest->phone);
                            if (str_starts_with($phone, '0')) {
                                $phone = '62' . substr($phone, 1);
                            }
                            $waLink = "https://wa.me/{$phone}?text=" . urlencode("Halo *" . $guest->name . "*, Kami mengundang Anda untuk hadir di acara pernikahan kami. Lihat undangan di sini: " . route('invitations.show', $invitation->slug) . "?to=" . urlencode($guest->name));
                        @endphp
                        <a href="{{ $waLink }}"
                            target="_blank"
                            class="flex-1 flex items-center justify-center gap-2 py-4 bg-emerald-500 text-white rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-emerald-600 shadow-lg shadow-emerald-500/20 transition-all">
                            <i class="fab fa-whatsapp text-xs"></i>
                            Kirim WA
                        </a>
                    @else
                        <button disabled class="flex-1 flex items-center justify-center gap-2 py-4 bg-slate-100 text-slate-400 rounded-xl text-[9px] font-black uppercase tracking-widest cursor-not-allowed">
                            <i class="fab fa-whatsapp text-xs"></i>
                            No Phone
                        </button>
                    @endif
                    <button title="Fitur Segera Hadir" class="w-12 flex items-center justify-center bg-slate-100 text-slate-400 rounded-xl hover:bg-slate-200 transition-all cursor-not-allowed">
                        <i class="fab fa-whatsapp"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full bg-white p-24 rounded-[3.5rem] border border-dashed border-slate-200 text-center"
        data-aos="zoom-in">
        <div
            class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-200 mx-auto mb-8">
            <i class="fas fa-users-slash text-3xl"></i>
        </div>
        <p class="text-slate-400 font-serif text-xl italic mb-10">Daftar tamu masih kosong, Mahakarya
            membutuhkan saksi.</p>
        <button @click="showAddModal = true"
            class="inline-flex items-center gap-4 bg-[#0F172A] text-[#C5A267] px-10 py-5 rounded-full shadow-xl hover:scale-105 transition-all text-[9px] font-black uppercase tracking-[0.4em]">
            Tambah Tamu Pertama
        </button>
    </div>
@endforelse

@if($invitation->getGuests->hasMorePages())
    <div id="load-more-trigger" data-next-url="{{ $invitation->getGuests->nextPageUrl() }}" class="col-span-full h-20 flex items-center justify-center py-10">
        <div class="w-10 h-10 border-4 border-slate-100 border-t-[#C5A267] rounded-full animate-spin"></div>
    </div>
@endif
