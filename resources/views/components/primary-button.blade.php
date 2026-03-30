<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#0F172A] border border-[#C5A267]/20 rounded-md font-semibold text-xs text-[#C5A267] uppercase tracking-widest hover:bg-[#C5A267] hover:text-[#0F172A] focus:bg-[#C5A267] focus:text-[#0F172A] active:bg-[#0F172A] focus:outline-none focus:ring-2 focus:ring-[#C5A267] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

