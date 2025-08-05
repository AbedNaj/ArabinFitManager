    @props(['href' => '#'])
    <section class="flex flex-col gap-4">
        <div class="flex items-center justify-between mb-4">
            <x-button wire:navigate href="{{ $href }}" label="{{ __('gym.create') }}" />

        </div>

    </section>
