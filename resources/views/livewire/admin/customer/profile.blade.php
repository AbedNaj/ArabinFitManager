    <div x-data="{
        editMode: false,
        tab: 'overview',
        payDebtId: null,
        payAmount: null,
        openPayModal(id, amount) {
            this.payDebtId = id;
            this.payAmount = amount;
            $openModal('payDebtModal')
        },
        openRegModal() { $openModal('addRegistrationModal') },
    }" class="min-h-screen bg-gradient-to-br from-bg to-surface py-4 sm:py-8">
        <div class="max-w-6xl mx-auto px-4">
            @php
                $customerStatus = App\Enums\CustomerStatusEnum::tryFrom($customer->status);
            @endphp


            <div class="bg-bg rounded-2xl shadow-xl border border-border mb-6 sm:mb-8 overflow-hidden">
                <div
                    class="bg-gradient-to-r from-primary to-indigo-600 dark:from-primary dark:to-purple-600 px-4 sm:px-8 py-4 sm:py-6">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                        <div class="text-white">
                            <template x-if="!editMode">
                                <div>
                                    <h1 class="text-xl sm:text-2xl font-bold mb-1">{{ $customer->name }}</h1>
                                    <p class="text-blue-100 dark:text-purple-100 text-sm">
                                        {{ __('customer.show_customer_info') }}
                                    </p>
                                </div>
                            </template>
                            <template x-cloak x-if="editMode">
                                <div>
                                    <h1 class="text-xl sm:text-2xl font-bold mb-1">
                                        {{ __('customer.edit_customer_info') }}
                                    </h1>
                                    <p class="text-blue-100 dark:text-purple-100 text-sm">{{ $customer->name }}</p>
                                </div>
                            </template>
                        </div>

                        <div class="flex items-center gap-2">
                            <x-button label="{{ __('common.edit_data') }}" x-show="!editMode"
                                @click="editMode = !editMode"
                                class="bg-white/20 dark:bg-white/10 backdrop-blur-sm text-white border-white/20 hover:bg-white/30 dark:hover:bg-white/20 hover:border-white/40 transition-all duration-300" />
                            <x-button x-cloak label="{{ __('common.edit_cancel') }}" x-show="editMode"
                                @click="editMode = !editMode"
                                class="bg-white/20 dark:bg-white/10 backdrop-blur-sm text-white border-white/20 hover:bg-white/30 dark:hover:bg-white/20 hover:border-white/40 transition-all duration-300" />
                        </div>
                    </div>
                </div>


                <div class="bg-bg rounded-2xl shadow-xl border border-border overflow-hidden">
                    <div class="border-b border-border bg-surface px-4 sm:px-6">
                        <nav class="-mb-px flex gap-6" aria-label="Tabs">
                            <button @click="tab = 'overview'"
                                :class="tab === 'overview' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-300' :
                                    'border-transparent text-secondary hover:text-text'"
                                class="whitespace-nowrap hover:cursor-pointer border-b-2 py-4 text-sm font-medium">
                                {{ __('common.overview') }}
                            </button>
                            <button @click="tab = 'registrations'" wire:click='getRegistrationInfo()'
                                :class="tab === 'registrations' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-300' :
                                    'border-transparent text-secondary hover:text-text'"
                                class="whitespace-nowrap border-b-2 hover:cursor-pointer py-4 text-sm font-medium">
                                {{ __('registration.registrations') }}
                            </button>
                            <button @click="tab = 'debts'" wire:click='getDebtInfo()'
                                :class="tab === 'debts' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-300' :
                                    'border-transparent text-secondary hover:text-text'"
                                class="whitespace-nowrap border-b-2 hover:cursor-pointer py-4 text-sm font-medium">
                                {{ __('debt.debts') }}
                            </button>

                        </nav>
                    </div>


                    @include('admin.partials.registration.overview-tab')

                    @include('admin.partials.registration.registration-tab')



                    @include('admin.partials.registration.debt-tab')



                </div>

                <style>
                    [x-cloak] {
                        display: none !important
                    }

                    ::-webkit-scrollbar {
                        width: 8px
                    }

                    ::-webkit-scrollbar-track {
                        background: var(--color-surface)
                    }

                    ::-webkit-scrollbar-thumb {
                        background: var(--color-border);
                        border-radius: 4px
                    }

                    ::-webkit-scrollbar-thumb:hover {
                        background: var(--color-secondary)
                    }

                    * {
                        transition-property: background-color, border-color, color, fill, stroke;
                        transition-duration: 200ms;
                        transition-timing-function: ease-in-out
                    }
                </style>
