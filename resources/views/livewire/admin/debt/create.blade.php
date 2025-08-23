<div class="min-h-screen bg-gradient-to-br from-bg to-surface py-4 sm:py-8">
    <div class="max-w-6xl mx-auto px-4">

        <div class="bg-bg rounded-2xl shadow-xl border border-border overflow-hidden mb-6">
            <div
                class="bg-gradient-to-r from-primary to-indigo-600 dark:from-primary dark:to-purple-600 px-4 sm:px-8 py-4 sm:py-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="text-white">
                        <h1 class="text-xl sm:text-2xl font-bold mb-1">{{ __('debt.add_debt') }}</h1>
                        <p class="text-white/80 text-sm">

                        </p>
                    </div>
                    <div class="flex items-center gap-2">

                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8">


                <section class="rounded-xl border border-border bg-bg p-4 sm:p-6 shadow-sm mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-text">{{ __('debt.select_customer') }}</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div class="md:col-span-2">
                            @if (!$notForCustomer)
                                <x-select class="min-w-full" label="{{ __('registration.select_customer') }}"
                                    wire:model.live="customer" placeholder="{{ __('registration.select_a_customer') }}"
                                    :async-data="route('api.customers.index')" option-label="name" option-value="id" />
                            @endif


                        </div>
                    </div>
                </section>

                @if ($customer)

                    <section class="rounded-2xl border border-border bg-bg p-4 sm:p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-text">{{ __('debt.add_debt') }}</h2>
                        </div>

                        <form wire:submit.prevent='create' method="POST" class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <x-input type="number" wire:model='debt_amount' label="{{ __('debt.amount') }}" />
                                </div>

                                <div>
                                    <x-input type="number" wire:model='paid_amount' label="{{ __('debt.paid') }}" />
                                </div>

                                <div>
                                    <x-datetime-picker label="{{ __('debt.debt_date') }}"
                                        placeholder="{{ __('registration.pick_date') }}" wire:model.live="debtDate"
                                        display-format="DD/MM/YYYY" without-time />
                                </div>
                            </div>

                            <div>
                                <x-textarea label="{{ __('debt.notes') }}" wire:model='note' />
                            </div>

                            <div class="flex items-center justify-end gap-3">
                                <button type="button"
                                    class="inline-flex items-center rounded-lg border border-border bg-bg text-text px-4 py-2.5 hover:bg-surface">
                                    {{ __('debt.cancel') }}
                                </button>
                                <button type="submit"
                                    class="inline-flex items-center rounded-lg bg-primary text-white px-4 py-2.5 shadow hover:opacity-90">
                                    {{ __('debt.create_debt') }}
                                </button>
                            </div>
                        </form>
                    </section>

                    <section class="rounded-xl border border-border bg-bg p-4 sm:p-6 shadow-sm my-6"
                        id="customer-summary">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-text">{{ __('debt.customer_summary') }}</h2>

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <div class="rounded-lg border border-border bg-surface p-4">
                                <div class="text-sm text-secondary">{{ __('debt.name') }}</div>
                                <div class="mt-1 font-semibold text-text">{{ $customerInfo->name }}</div>
                                <div class="mt-3 text-xs text-secondary">
                                    {{ __('debt.phone') }}:
                                    <span class="font-medium text-text">
                                        {{ $customerInfo->phone ?? __('common.no_data') }}
                                    </span>
                                </div>
                            </div>

                            <div class="rounded-lg border border-border bg-surface p-4">
                                <div class="text-sm text-secondary">{{ __('debt.debt_status') }}</div>
                                <div class="mt-2">
                                    <span
                                        class="text-xs px-2 py-1 rounded bg-{{ $hasDebts ? 'red' : 'green' }}-100 text-{{ $hasDebts ? 'red' : 'green' }}-700 border border-{{ $hasDebts ? 'red' : 'green' }}-200">
                                        {{ $hasDebts ? __('debt.has_debts') : __('debt.no_debts') }}
                                    </span>
                                </div>
                                <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
                                    <div>
                                        <p class="text-secondary">{{ __('debt.total_debts') }}</p>
                                        <p class="font-semibold text-text">{{ $debtsAmount }} ₪</p>
                                    </div>
                                    <div>
                                        <p class="text-secondary">{{ __('debt.paid_amount') }}</p>
                                        <p class="font-semibold text-text">{{ $paidAmount }} ₪</p>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-lg border border-border bg-surface p-4">
                                <div class="text-sm text-secondary">{{ __('debt.remaining') }}</div>
                                <div class="mt-1 text-2xl font-extrabold text-text">{{ $remainingAmount }} ₪</div>
                                <div class="mt-3">
                                    <div class="w-full h-2 rounded bg-border overflow-hidden">
                                        <div class="h-2 bg-primary" style="width: {{ $paidPercentage }}%;"></div>
                                    </div>
                                    <p class="mt-2 text-xs text-secondary">
                                        {{ __('debt.paid_percentage') }}:
                                        <span class="font-medium text-text">{{ $paidPercentage }}%</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 rounded-lg border border-border bg-surface p-4">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-sm font-medium text-text">{{ __('debt.last_debts') }}</h3>
                                <a href="#"
                                    class="text-xs text-primary hover:underline">{{ __('debt.view_all') }}</a>
                            </div>

                            <div class="overflow-hidden rounded-md border border-border">
                                <table class="w-full text-sm">
                                    <thead class="bg-bg">
                                        <tr>
                                            <th class="p-3 text-start text-secondary font-medium">
                                                {{ __('debt.debt_date') }}</th>
                                            <th class="p-3 text-start text-secondary font-medium">{{ __('debt.name') }}
                                            </th>
                                            <th class="p-3 text-start text-secondary font-medium">
                                                {{ __('debt.amount') }}</th>
                                            <th class="p-3 text-start text-secondary font-medium">{{ __('debt.paid') }}
                                            </th>
                                            <th class="p-3 text-start text-secondary font-medium">
                                                {{ __('debt.status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-border">
                                        @forelse ($customerInfo->debts as $debt)
                                            <tr class="hover:bg-bg/60">
                                                <td class="p-3 text-text">{{ $debt->debt_date }}</td>
                                                <td class="p-3 text-text">{{ $customerInfo->name }}</td>
                                                <td class="p-3 text-text">{{ $debt->amount }}</td>
                                                <td class="p-3 text-text">{{ $debt->paid }}</td>
                                                <td class="p-3">
                                                    <span
                                                        class="text-xs px-2 py-0.5 rounded bg-yellow-100 text-yellow-700 border border-yellow-200">
                                                        {{ __('debt.unpaid') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="px-4 sm:px-6 py-8 text-center">
                                                    <div
                                                        class="flex flex-col items-center justify-center text-gray-500">
                                                        <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                        <p class="text-sm font-medium">{{ __('common.no_data') }}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>



                @endif
            </div>
        </div>
    </div>
</div>
