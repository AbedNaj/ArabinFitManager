<div>
    <form wire:submit.prevent='register' method="post" class="space-x-0 px-2 space-y-4">
        @csrf


        <x-input :readonly="true" wire:model='customerName' label="{{ __('customer.name') }}" />
        <x-select wire:model.live="plan" label="{{ __('registration.plan') }}"
            placeholder="{{ __('registration.select_plan') }}" :options="$plans" option-label="name" option-value="id" />
        @if ($planPrice)
            <p class="text-gray-500 text-sm">{{ __('registration.plan_price') . ' : ' . $planPrice }}</p>
        @endif

        <x-datetime-picker label="{{ __('registration.start_date') }}" placeholder="{{ __('registration.pick_date') }}"
            wire:model.live="startDate" display-format="DD/MM/YYYY" without-time />

        @if ($endDate)
            <p class="text-gray-500 text-sm">{{ __('registration.end_date') . ' : ' . $endDate }}</p>
        @endif

        <div class="mt-2">
            <x-button type="submit" label="{{ __('registration.register') }}" />
            <x-button wire:navigate href="{{ route('admin.registrations.index') }}" label="{{ __('common.cancel') }}"
                outline hover="warning" focus:solid.gray />

        </div>
    </form>
</div>
