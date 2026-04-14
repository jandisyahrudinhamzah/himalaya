@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white/20 border border-white/30 text-white rounded-lg focus:ring-green-400']) }}/>