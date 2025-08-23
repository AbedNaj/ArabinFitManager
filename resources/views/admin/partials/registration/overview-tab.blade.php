<div x-show="tab === 'overview'" x-transition class="p-4 sm:p-8 space-y-8">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">

        <div class="group">
            <div class="flex items-center space-x-3 rtl:space-x-reverse mb-3">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-primary to-indigo-600 dark:from-primary dark:to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xs sm:text-sm font-medium text-secondary uppercase tracking-wider">
                    {{ __('customer.name') }}
                </h3>
            </div>
            <div
                class="bg-surface rounded-xl p-4 group-hover:bg-gray-100 dark:group-hover:bg-slate-600 transition-colors duration-200 border border-border/50">
                <p class="text-lg font-semibold text-text break-words">{{ $customer->name }}</p>
            </div>
        </div>


        <div class="group">
            <div class="flex items-center space-x-3 rtl:space-x-reverse mb-3">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-accent to-orange-600 dark:from-accent dark:to-orange-500 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xs sm:text-sm font-medium text-secondary uppercase tracking-wider">
                    {{ __('customer.phone') }}
                </h3>
            </div>
            <div
                class="bg-surface rounded-xl p-4 group-hover:bg-gray-100 dark:group-hover:bg-slate-600 transition-colors duration-200 border border-border/50">
                <p class="text-lg font-semibold text-text break-words">
                    {{ $customer->phone ?? __('common.no_data') }}
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @php
            $customerStatus = App\Enums\CustomerStatusEnum::tryFrom($customer->status);
        @endphp
        <div class="rounded-2xl border border-border bg-bg p-5">
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-sm font-medium text-secondary">
                    {{ __('registration.last_status') }}
                </h4>
                <span
                    class="text-xs px-2 py-1 rounded-full bg-{{ $customerStatus->color() }}-100 text-{{ $customerStatus->color() }}-700 dark:bg-{{ $customerStatus->color() }}-900/30 dark:text-{{ $customerStatus->color() }}-200">
                    {{ $customerStatus->label() }}
                </span>
            </div>
            <p class="text-sm text-secondary">
                {{ __('registration.period') }}:
                <span class="font-medium text-text">{{ $currentRegistration->start_date ?? '—' }} -
                    {{ $currentRegistration->end_date ?? '—' }}</span>
            </p>
            <p class="text-sm text-secondary mt-1">
                {{ __('registration.plan') }}:
                <span class="font-medium text-text">{{ $currentRegistration->plan->name ?? '—' }}</span>
            </p>
            <div class="mt-4">
                @if ($canRegister == true)
                    <x-button size="sm" wire:navigate
                        href="{{ route('admin.registrations.create', ['customer' => $customer->id]) }}"
                        label="{{ __('registration.new_registration') }}" icon="plus" />
                @endif

            </div>
        </div>

        <div class="rounded-2xl border border-border bg-bg p-5">
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
                <div>
                    <p class="text-secondary">{{ __('debt.remaining_debt') }}</p>
                    <p class="font-semibold text-text">{{ $remainingAmount }} ₪</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-border bg-bg p-5">
            <h4 class="text-sm font-medium text-secondary mb-3">{{ __('common.notes') }}</h4>
            <p class="text-sm text-secondary">
                {{ $customer->notes ?? __('common.no_notes') }}
            </p>
            <div class="mt-4">
                <x-button size="sm" label="{{ __('common.add_note') }}" icon="pencil-square" />
            </div>
        </div>
    </div>
</div>
