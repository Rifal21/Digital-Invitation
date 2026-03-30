@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#C5A267] focus:ring-[#C5A267] rounded-md shadow-sm']) }}>

