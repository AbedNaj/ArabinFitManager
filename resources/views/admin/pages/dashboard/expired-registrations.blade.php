@extends('admin.layout.default')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-bg to-surface py-4 sm:py-8">
        <div class="max-w-6xl mx-auto px-4">


            <div class="bg-bg rounded-2xl shadow-xl border border-border overflow-hidden mb-6 sm:mb-8">
                <div
                    class="bg-gradient-to-r from-primary to-indigo-600 dark:from-primary dark:to-purple-600 px-4 sm:px-8 py-5">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="text-white">
                            <h1 class="text-xl sm:text-2xl font-bold mb-1">الاشتراكات المنتهية</h1>
                            <p class="text-blue-100 dark:text-purple-100 text-sm">قائمة بجميع الاشتراكات التي انتهت صلاحيتها.
                            </p>
                        </div>

                        <div class="flex items-center gap-2">
                            <span
                                class="inline-flex items-center rounded-full bg-white/15 backdrop-blur px-3 py-1 text-white text-sm">
                                الإجمالي:
                                <span
                                    class="font-semibold ms-1">{{ $registrations->total() ?? count($registrations ?? []) }}</span>
                            </span>
                        </div>
                    </div>
                </div>


                <div class="p-4 sm:p-6">
                    <div class="overflow-x-auto rounded-xl border border-border">
                        <table class="min-w-full bg-bg text-sm">
                            <thead class="bg-surface/60">
                                <tr class="text-start">
                                    <th class="px-4 py-3 text-start text-text/70 font-semibold">#</th>
                                    <th class="px-4 py-3 text-start text-text/70 font-semibold">
                                        {{ __('registration.customer_name') }}</th>
                                    <th class="px-4 py-3 text-start text-text/70 font-semibold">
                                        {{ __('registration.plan') }}</th>
                                    <th class="px-4 py-3 text-start text-text/70 font-semibold">
                                        {{ __('registration.start_date') }} </th>
                                    <th class="px-4 py-3 text-start text-text/70 font-semibold">
                                        {{ __('registration.end_date') }} </th>
                                    <th class="px-4 py-3 text-start text-text/70 font-semibold">
                                        {{ __('registration.payment_status') }} </th>
                                    <th class="px-4 py-3 text-start text-text/70 font-semibold">{{ __('common.actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($registrations as $registration)
                                    <tr class="border-t border-border hover:bg-surface/40">
                                        <td class="px-4 py-3 align-top">
                                            {{ $loop->iteration + (($registrations->currentPage() ?? 1) - 1) * ($registrations->perPage() ?? $registrations->count()) }}
                                        </td>

                                        <td class="px-4 py-3 align-top">
                                            <div class="flex flex-col">
                                                <a href="{{ route('admin.customers.show', $registration->customer_id) }}"
                                                    class="font-medium hover:underline">
                                                    {{ $registration->customer->name ?? '—' }}
                                                </a>
                                                <span class="text-xs text-text/60">
                                                    رقم: {{ $registration->customer_id }}
                                                </span>
                                            </div>
                                        </td>

                                        <td class="px-4 py-3 align-top">
                                            {{ $registration->plan->name ?? '—' }}
                                        </td>

                                        <td class="px-4 py-3 align-top">
                                            {{ $registration->start_date }}
                                        </td>

                                        <td class="px-4 py-3 align-top">
                                            <span
                                                class="inline-flex items-center rounded-full bg-red-100/60 dark:bg-red-500/10 text-red-700 dark:text-red-300 px-2 py-0.5 text-xs">
                                                {{ $registration->end_date }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-3 align-top">
                                            @php
                                                $paymentStatus = App\Enums\RegistrationPaymentStatusEnum::tryFrom(
                                                    $registration->payment_status,
                                                );
                                            @endphp
                                            <span
                                                class="inline-flex items-center rounded-full px-2 py-0.5 text-xs
                                            bg-{{ $paymentStatus->color() }}-100/60 text-{{ $paymentStatus->color() }}-700 dark:bg-{{ $paymentStatus->color() }}-500/10 dark:text-{{ $paymentStatus->color() }}-300'">
                                                {{ $paymentStatus->label() }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-3 align-top">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('admin.registrations.create', ['customer' => $registration->customer_id]) }}"
                                                    class="inline-flex items-center rounded-lg border border-border px-3 py-1.5 text-xs font-medium hover:bg-surface/60">
                                                    {{ __('registration.renew') }}
                                                </a>

                                                <a href="{{ route('admin.registrations.show', $registration->id) }}"
                                                    class="inline-flex items-center rounded-lg border border-border px-3 py-1.5 text-xs hover:bg-surface/60">
                                                    {{ __('common.details') }}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-10">
                                            <div class="flex flex-col items-center justify-center text-center gap-2">
                                                <div class="text-xl">لا توجد اشتراكات منتهية</div>
                                                <p class="text-text/60 text-sm">جميع الاشتراكات الحالية فعّالة أو بانتظار
                                                    البدء.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>


                    @if (method_exists($registrations, 'links'))
                        <div class="mt-4">
                            {{ $registrations->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
