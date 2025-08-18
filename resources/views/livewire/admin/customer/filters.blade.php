    <div class="flex items-center py-2 gap-2">

        <div>

            <x-select :options="$options" option-label="name" option-value="id" wire:model.live="customerStatus"
                placeholder="{{ __('customer.select_status') }}" label="{{ __('customer.status') }}" />



        </div>
    </div>
