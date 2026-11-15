@props(['headers' => []])

<div class="overflow-x-auto">
    <table {{ $attributes->merge(['class' => 'min-w-full text-sm']) }}>
        @if(count($headers))
            <thead>
                <tr class="border-b border-white/40 dark:border-white/10">
                    @foreach($headers as $header)
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 dark:text-slate-400 uppercase tracking-wide">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>
        @endif
        <tbody class="divide-y divide-white/30 dark:divide-white/5">
            {{ $slot }}
        </tbody>
    </table>
</div>
