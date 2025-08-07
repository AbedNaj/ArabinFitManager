    @props(['href' => '#', 'label' => ''])
    <section class="flex flex-col gap-4">
        <div class="flex items-center justify-between mb-4">


            <x-button wire:navigate href="{{ $href }}" lg label="{{ $label }}" />
        </div>

    </section>
