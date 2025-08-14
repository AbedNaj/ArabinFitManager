@props([
    'icon' => '',
    'iconColor' => 'green',
    'title' => 'title',
    'data' => '',
    'compare' => false,
    'subTitle' => '',
    'subData' => '',
    'currency' => false,
])
<div class="bg-bg p-5 rounded-2xl border border-border shadow-sm">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-sm text-secondary">{{ $title }}</p>
            <p class="text-3xl font-extrabold mt-1">{{ $data }} {{ $currency ? '₪' : '' }} </p>

            <div class="mt-2"> {{ $slot }}</div>
        </div>
        <div
            class="w-10 h-10 rounded-xl bg-{{ $iconColor }}-100 text-{{ $iconColor }}-600 grid place-items-center">

            {!! $icon !!}

        </div>

    </div>
    @if ($subTitle)
        <div class="text-xs text-secondary mt-2">{{ $subTitle }}: <span
                class="font-semibold">{{ $subData }}</span>
        </div>
    @endif

    @if ($compare)
        <span
            class="inline-block mt-3 text-xs text-green-700 bg-green-100 px-2 py-0.5 rounded">{{ __('dashboard.vs_prev_period_up', ['pct' => '+5.2%']) }}</span>
    @endif

</div>
