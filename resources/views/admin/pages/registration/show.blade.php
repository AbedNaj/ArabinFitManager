@extends('admin.layout.default')

@section('content')
    @php
        $registrationStatus = App\Enums\RegistrationStatusEnum::tryFrom($data->status);

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
                                {{ __('registration.show_description') ?? 'عرض شامل لمعلومات الاشتراك وحالة الدفع والخطة.' }}
                            </p>
                        </div>

                        <div class="flex space-x-2 ">
                            <x-button label="{{ __('registration.customer_name') }}" />

                            <x-button label="{{ __('registration.cancel') }}" />

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
                                {{ $data->customer->name }}
                            </div>
                            <div class="mt-2 flex items-center gap-2">
                                <span
                                    class="text-xs px-2 py-0.5 rounded bg-{{ $registrationStatus->color() }}-100 text-{{ $registrationStatus->color() }}-700 border border-{{ $registrationStatus->color() }}-200">{{ $registrationStatus->label() }}</span>
                                <span
                                    class="text-xs px-2 py-0.5 rounded bg-blue-100 text-blue-700 border border-blue-200">{{ __('registration.partial_payment') ?? 'مدفوع جزئياً' }}</span>
                            </div>
                        </div>

                        <div class="rounded-xl border border-border bg-bg p-4 shadow-sm">
                            <h3 class="text-sm text-secondary">{{ __('registration.plan') }}</h3>
                            <div class="mt-2 font-semibold text-text">{{ $data->plan->name }}</div>
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
                            <h3 class="text-sm text-secondary">{{ __('registration.payment') ?? 'الدفع' }}</h3>
                            <div class="mt-2 grid grid-cols-2 gap-2 text-sm">
                                <div class="space-y-1">
                                    <p class="text-secondary">{{ __('registration.total_amount') ?? 'المبلغ الكلي' }}</p>
                                    <p class="font-medium text-text">150 ₪</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-secondary">{{ __('registration.paid_amount') ?? 'المدفوع' }}</p>
                                    <p class="font-medium text-text">100 ₪</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="w-full h-2 rounded bg-border overflow-hidden">
                                    <div class="h-2 bg-primary" style="width: 66%;"></div>
                                </div>
                                <p class="mt-2 text-xs text-secondary">{{ __('registration.remaining') ?? 'المتبقي' }}:
                                    <span class="font-medium text-text">50 ₪</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-border bg-bg p-4 sm:p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-3 sm:mb-4">
                            <div class="flex items-center gap-2">
                                <h2 class="text-lg font-semibold text-text">
                                    {{ __('registration.payment_history') ?? 'سجل المدفوعات' }}</h2>
                                <span
                                    class="text-[10px] px-2 py-0.5 rounded bg-surface border border-border text-secondary">{{ __('registration.last_update') ?? 'آخر تحديث' }}:
                                    12:35</span>
                            </div>
                            <a href="#"
                                class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-gradient-to-r from-primary to-indigo-600 dark:from-primary dark:to-purple-600 text-white shadow hover:opacity-95 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <span class="text-sm">{{ __('registration.add_payment') ?? 'إضافة دفعة' }}</span>
                            </a>
                        </div>

                        <div class="overflow-hidden rounded-lg border border-border">
                            <table class="w-full text-sm">
                                <thead class="bg-surface">
                                    <tr>
                                        <th class="p-3 text-start text-secondary font-medium">
                                            {{ __('registration.date') ?? 'التاريخ' }}</th>
                                        <th class="p-3 text-start text-secondary font-medium">
                                            {{ __('registration.method') ?? 'الطريقة' }}</th>
                                        <th class="p-3 text-start text-secondary font-medium">
                                            {{ __('registration.amount') ?? 'المبلغ' }}</th>
                                        <th class="p-3 text-start text-secondary font-medium">
                                            {{ __('registration.employee') ?? 'الموظف' }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border">
                                    <tr class="hover:bg-surface/60">
                                        <td class="p-3 text-text">2025-08-01</td>
                                        <td class="p-3 text-text">{{ __('registration.cash') ?? 'نقدي' }}</td>
                                        <td class="p-3 font-medium text-text">70 ₪</td>
                                        <td class="p-3 text-text">سارة</td>
                                    </tr>
                                    <tr class="hover:bg-surface/60">
                                        <td class="p-3 text-text">2025-08-01</td>
                                        <td class="p-3 text-text">{{ __('registration.bank_transfer') ?? 'تحويل بنكي' }}
                                        </td>
                                        <td class="p-3 font-medium text-text">30 ₪</td>
                                        <td class="p-3 text-text">محمد</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <p class="mt-3 text-xs text-secondary">*
                            {{ __('registration.late_payments_note') ?? 'المدفوعات المتأخرة ستظهر هنا عند إضافتها.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
