<div>
    <div class="flex items-center gap-2">
        <x-select :options="$registrationOptions" option-label="name" option-value="id" wire:model.live="registrationStatus"
            placeholder="{{ __('registration.select_status') }}" label="{{ __('registration.status') }}" />


        <x-select :options="$paymentOptions" option-label="name" option-value="id" wire:model.live="paymentStatus"
            placeholder="{{ __('registration.select_payment_status') }}"
            label="{{ __('registration.payment_status') }}" />

    </div>

</div>
