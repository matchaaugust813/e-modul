@props(['type' => 'success', 'message'])

@php
$classes = match($type) {
    'success' => 'bg-emerald-50/80 border-emerald-300/70 text-emerald-800',
    'error'   => 'bg-rose-50/80 border-rose-300/70 text-rose-800',
    'warning' => 'bg-amber-50/80 border-amber-300/70 text-amber-800',
    default   => 'bg-sky-50/80 border-sky-300/70 text-sky-800',
};
@endphp

<div class="border-l-4 p-4 rounded-2xl backdrop-blur-sm {{ $classes }}" role="alert">
    {{ $message }}
</div>
