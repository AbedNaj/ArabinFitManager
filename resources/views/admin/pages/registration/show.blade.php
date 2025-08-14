@extends('admin.layout.default')

@section('content')
    @php
        $registrationStatus = App\Enums\RegistrationStatusEnum::tryFrom($data->status);
        $registrationPaymentStatus = App\Enums\RegistrationPaymentStatusEnum::tryFrom($data->payment_status);

        $activeStatus = App\Enums\RegistrationStatusEnum::ACTIVE->value;
        $freezdStatus = App\Enums\RegistrationStatusEnum::FREEZED->value;
    @endphp
    <div class="min-h-screen bg-gradient-to-br from-bg to-surface py-4 sm:py-8">
        <div class="max-w-6xl mx-auto px-4">

            <div class="bg-bg rounded-2xl shadow-xl border border-border overflow-hidden mb-6 sm:mb-8">

                <div
                    class="bg-gradient-to-r from-primary to-indigo-600 dark:from-primary dark:to-purple-600 px-4 sm:px-8 py-4 sm:py-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="text-white">
                            <h1 class="text-xl sm:text-2xl font-bold mb-1">{{ __('registration.title') }}</h1>
                            <p class="text-blue-100 dark:text-purple-100 text-sm">
                                {{ __('registration.show_description') }}
                            </p>
                        </div>

                        <div class="flex space-x-2 ">
                            @if ($data->cusomter)
                                <x-button wire:navigate
                                    href="{{ route('admin.customers.show', ['customer' => $data->customer]) }}"
                                    label="{{ __('registration.customer_details') }}" />
                            @endif

                            @if ($data->status == $activeStatus || $data->status == $freezdStatus)
                                <x-admin.delete-modal :route="route('admin.registrations.delete', ['registration' => $data->id])" :buttonLabel="__('registration.delete_title')" :description="__('registration.delete_title_description')"
                                    :title="__('registration.delete_title')" />
                            @endif


                        </div>
                    </div>
                </div>


                <div class="p-4 sm:p-8">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 mb-6">
                        <div class="rounded-xl border border-border bg-bg p-4 shadow-sm">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm text-secondary">{{ __('registration.information') }}</h3>

                            </div>
                            <div class="mt-3 text-xl font-semibold text-text">{{ __('registration.customer_name') }}:
                                {{ $data->customer->name ?? __('common.no_data') }}
                            </div>
                            <div class="mt-2 flex items-center gap-2">
                                <span
                                    class="text-xs px-2 py-0.5 rounded bg-{{ $registrationStatus->color() }}-100 text-{{ $registrationStatus->color() }}-700 border border-{{ $registrationStatus->color() }}-200">{{ $registrationStatus->label() }}</span>
                                <span
                                    class="text-xs px-2 py-0.5 rounded bg-{{ $registrationPaymentStatus->color() }}-100 text-{{ $registrationPaymentStatus->color() }}-700 border border-{{ $registrationPaymentStatus->color() }}-200">{{ $registrationPaymentStatus->label() }}</span>
                            </div>
                        </div>

                        <div class="rounded-xl border border-border bg-bg p-4 shadow-sm">
                            <h3 class="text-sm text-secondary">{{ __('registration.plan') }}</h3>
                            <div class="mt-2 font-semibold text-text">{{ $data->plan->name ?? __('common.no_data') }}</div>
                            <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
                                <div class="space-y-1">
                                    <p class="text-secondary">{{ __('registration.start_date') }}</p>
                                    <p class="font-medium text-text">{{ $data->start_date }}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-secondary">{{ __('registration.end_date') }}</p>
                                    <p class="font-medium text-text">{{ $data->end_date }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-xl border border-border bg-bg p-4 shadow-sm">
                            <h3 class="text-sm text-secondary">{{ __('registration.payment') }}</h3>
                            <div class="mt-2 grid grid-cols-2 gap-2 text-sm">
                                <div class="space-y-1">
                                    <p class="text-secondary">{{ __('registration.total_amount') }}</p>
                                    <p class="font-medium text-text">{{ $data->price_at_signup }} ₪</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-secondary">{{ __('registration.paid_amount') }}</p>
                                    <p class="font-medium text-text">{{ $totalPaid }} ₪</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="w-full h-2 rounded bg-border overflow-hidden">
                                    <div class="h-2 bg-primary"
                                        style="width: {{ ($totalPaid / $data->price_at_signup) * 100 }}%;"></div>
                                </div>
                                <p class="mt-2 text-xs text-secondary">{{ __('registration.remaining') }}:
                                    <span class="font-medium text-text">{{ $remainingAmount }} ₪</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-border bg-bg p-4 sm:p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-3 sm:mb-4">
                            <div class="flex items-center gap-2">
                                <h2 class="text-lg font-semibold text-text">
                                    {{ __('registration.payment_history') ?? 'سجل المدفوعات' }}</h2>

                            </div>
                            @if ($remainingAmount > 0 && $registrationStatus->value != App\Enums\RegistrationStatusEnum::STOPPED->value)
                                <x-button wire:navigate
                                    href="{{ route('admin.debts.show', ['debt' => $data->debt->id ?? 0]) }}"
                                    label="{{ __('registration.add_payment') }}" />
                            @endif

                        </div>

                        <div class="overflow-hidden rounded-lg border border-border">
                            <table class="w-full text-sm">
                                <thead class="bg-surface">
                                    <tr>
                                        <th class="p-3 text-start text-secondary font-medium">
                                            {{ __('registration.date') }}</th>

                                        <th class="p-3 text-start text-secondary font-medium">
                                            {{ __('registration.amount') }}</th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border">
                                    @forelse ($data->payments as $payment)
                                        <tr class="hover:bg-surface/60">
                                            <td class="p-3 text-text">{{ $payment->created_at->format('d/m/x') }}</td>
                                            <td class="p-3 text-text">{{ $payment->amount }}</td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-4 sm:px-6 py-8 text-center">
                                                <div class="flex flex-col items-center justify-center text-gray-500">
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
                </div>
            </div>
        </div>
    </div>
@endsection
