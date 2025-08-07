@props(['icon' => '', 'text' => '', 'isActive' => false, 'href' => '#'])
<a href="{{ $href }}" wire:navigate
    class="flex items-center px-4 py-3 rounded-lg {{ $isActive ? 'bg-primary/10 text-primary' : 'text-secondary hover:bg-surface hover:text-text' }}">
    {!! $icon !!}
    <span>{{ $text }}</span>
</a>
