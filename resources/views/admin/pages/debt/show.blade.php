@extends('admin.layout.default')
@section('content')
    @php
        $debtStatus = App\Enums\DebtStatusEnum::tryFrom($data->status);
    @endphp
    <div class="min-h-screen bg-gradient-to-br from-bg to-surface py-4 sm:py-8">
        <div class="max-w-6xl mx-auto px-4">


            <div class="bg-bg rounded-2xl shadow-xl border border-border overflow-hidden mb-6">
                <div
                    class="bg-gradient-to-r from-primary to-indigo-600 dark:from-primary dark:to-purple-600 px-4 sm:px-8 py-4 sm:py-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="text-white">
                            <h1 class="text-xl sm:text-2xl font-bold mb-1">
                                {{ __('debt.debt_details') }}
                            </h1>

                        </div>
                        <div class="flex items-center gap-2">
                            @if ($data->registration_id)
                                <x-button
                                    href="{{ route('admin.registrations.show', ['registration' => $data->registration_id]) }}"
                                    wire:navigate label="{{ __('debt.see_registration_details') }}" />
                            @endif

                        </div>
                    </div>
                </div>


                <div class="p-4 sm:p-8">

                    <section class="rounded-xl border border-border bg-bg p-4 sm:p-6 shadow-sm mb-6">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-4">
                            <div class="space-y-2">
                                <h2 class="text-lg font-semibold text-text">{{ __('debt.debt_date') }}: <span
                                        class="font-normal">{{ $data->debt_date ?? '—' }}</span></h2>
                                <div class="flex flex-wrap items-center gap-2">

                                    <span
                                        class="text-xs px-2 py-1 rounded bg-{{ $debtStatus->color() }}-100 text-{{ $debtStatus->color() }}-700 border border-{{ $debtStatus->color() }}-200">
                                        {{ $debtStatus->label() }}
                                    </span>


                                    @if (!empty($data->registration_id ?? null))
                                        <span
                                            class="text-xs px-2 py-1 rounded border border-border bg-surface text-secondary">
                                            {{ __('debt.followd_to_registration') }} <span
                                                class="font-medium text-text"></span>
                                        </span>
                                        <span>

                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 w-full md:w-auto">
                                <div class="rounded-lg border border-border bg-surface p-3">
                                    <div class="text-xs text-secondary">{{ __('debt.amount') }}</div>
                                    <div class="mt-1 text-lg font-bold text-text">{{ $data->amount ?? 0 }} ₪</div>
                                </div>
                                <div class="rounded-lg border border-border bg-surface p-3">
                                    <div class="text-xs text-secondary">{{ __('debt.paid_amount') }}</div>
                                    <div class="mt-1 text-lg font-bold text-text">{{ $data->paid ?? 0 }} ₪</div>
                                </div>
                                <div class="rounded-lg border border-border bg-surface p-3 col-span-2 md:col-span-1">
                                    <div class="text-xs text-secondary">{{ __('debt.remaining') }}</div>
                                    <div class="mt-1 text-lg font-extrabold text-text">
                                        {{ ($data->amount ?? 0) - ($data->paid ?? 0) }} ₪
                                    </div>
                                </div>
                            </div>
                        </div>


                        @php
                            $amount = (float) ($data->amount ?? 0);
                            $paid = (float) ($data->paid ?? 0);
                            $percent = $amount > 0 ? min(100, round(($paid / $amount) * 100)) : 0;
                        @endphp
                        <div>
                            <div class="w-full h-2 rounded bg-border overflow-hidden">
                                <div class="h-2 bg-primary" style="width: {{ $percent }}%;"></div>
                            </div>
                            <p class="mt-2 text-xs text-secondary">
                                {{ __('debt.paid_percentage') }}:
                                <span class="font-medium text-text">{{ $percent }}%</span>
                            </p>
                        </div>
                    </section>




                    <section class="rounded-2xl border border-border bg-bg p-4 sm:p-6 shadow-sm mb-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                            <h2 class="text-lg font-semibold text-text">{{ __('debt.debt_pay') }}</h2>

                        </div>

                        <form action="{{ route('admin.debts.update', ['debt' => $data]) }}" method="POST"
                            class="space-y-5">
                            @csrf
                            @method('PATCH')
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <x-input disabled="ture" label="{{ __('debt.customer_name') }}"
                                        value="{{ $data->customer->name }}" />
                                </div>
                                <div>
                                    <x-input readonly name="remaining_amount" label="{{ __('debt.remaining_debt') }}"
                                        value="{{ ($data->amount ?? 0) - ($data->paid ?? 0) }}" />
                                </div>

                                <div>
                                    <x-input value="0" name="paid_amount" min="0" type="number"
                                        label="{{ __('debt.paid_amount') }}" />
                                </div>

                            </div>

                            <div>
                                <x-textarea label="{{ __('debt.notes') }}" readonly
                                    value="{{ $data->note ?? __('debt.no_notes') }}" />
                            </div>

                            <div class="flex flex-wrap items-center  gap-3">

                                <x-button type="submit" label="{{ __('debt.pay') }}" lg />

                            </div>
                        </form>
                    </section>


                    <section class="rounded-2xl border border-border bg-bg p-4 sm:p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-sm font-medium text-text">
                                {{ __('registration.payment_history') ?? 'سجل المدفوعات' }}</h3>
                        </div>

                        <div class="overflow-hidden rounded-md border border-border">
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
                                            <td colspan="4" class="px-4 sm:px-6 py-8 text-center">
                                                <div class="flex flex-col items-center justify-center text-secondary">
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
                    </section>

                </div>
            </div>
        </div>
    </div>
@endsection
