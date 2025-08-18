<div class="flex items-center gap-2">
    <x-select :options="$options" option-label="name" option-value="id" wire:model.live="debtStatus"
        placeholder="{{ __('debt.select_debt_status') }}" label="{{ __('debt.status') }}" />
</div>
