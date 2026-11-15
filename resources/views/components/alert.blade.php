@props(['type' => 'success', 'message'])

@php
$classes = match($type) {
    'success' => 'bg-emerald-50/80 border-emerald-300/70 text-emerald-800 dark:bg-emerald-950/40 dark:border-emerald-700/60 dark:text-emerald-300',
    'error'   => 'bg-rose-50/80 border-rose-300/70 text-rose-800 dark:bg-rose-950/40 dark:border-rose-700/60 dark:text-rose-300',
    'warning' => 'bg-amber-50/80 border-amber-300/70 text-amber-800 dark:bg-amber-950/40 dark:border-amber-700/60 dark:text-amber-300',
    default   => 'bg-sky-50/80 border-sky-300/70 text-sky-800 dark:bg-sky-950/40 dark:border-sky-700/60 dark:text-sky-300',
};
@endphp

<div class="border-l-4 p-4 rounded-2xl backdrop-blur-sm {{ $classes }}" role="alert">
    {{ $message }}
</div>
