             <div x-show="tab === 'registrations'" x-transition class="p-4 sm:p-8">
                 <div class="flex items-center justify-between mb-4">
                     <h3 class="text-lg font-semibold">{{ __('registration.registrations_history') }}</h3>
                     @if ($canRegister == true)
                         <x-button wire:navigate label="{{ __('registration.new_registration') }}" icon="plus"
                             href="{{ route('admin.registrations.create', ['customer' => $customer->id]) }}" />
                     @endif
                 </div>

                 <div class="overflow-x-auto rounded-xl border border-border">
                     <table class="min-w-full divide-y divide-border">
                         <thead class="bg-surface">
                             <tr>
                                 <th class="px-4 py-3 text-start text-xs font-medium text-secondary">
                                     {{ __('registration.plan') }}</th>
                                 <th class="px-4 py-3 text-start text-xs font-medium text-secondary">
                                     {{ __('registration.start_date') }}</th>
                                 <th class="px-4 py-3 text-start text-xs font-medium text-secondary">
                                     {{ __('registration.end_date') }}</th>
                                 <th class="px-4 py-3 text-start text-xs font-medium text-secondary">
                                     {{ __('registration.status') }}</th>
                                 <th class="px-4 py-3 text-start text-xs font-medium text-secondary">
                                     {{ __('payment.payment_status') }}</th>
                                 <th class="px-4 py-3 text-start text-xs font-medium text-secondary">
                                     {{ __('common.actions') }}</th>
                             </tr>
                         </thead>
                         <tbody class="divide-y divide-border bg-bg">

                             @forelse($registrations ?? [] as $reg)
                                 @php
                                     $regStatus = App\Enums\RegistrationStatusEnum::tryFrom($reg->status);
                                     $regPaymentStatus = App\Enums\RegistrationPaymentStatusEnum::tryFrom(
                                         $reg->payment_status,
                                     );
                                 @endphp
                                 <tr class="hover:bg-surface">
                                     <td class="px-4 py-3 text-sm">{{ $reg->plan->name ?? '—' }}</td>
                                     <td class="px-4 py-3 text-sm">{{ $reg->start_date ?? '—' }}</td>
                                     <td class="px-4 py-3 text-sm">{{ $reg->end_date ?? '—' }}</td>
                                     <td class="px-4 py-3">
                                         <span
                                             class="text-xs px-2 py-1 rounded-full bg-{{ $regStatus->color() }}-100 text-{{ $regStatus->color() }}-700 dark:bg-{{ $regStatus->color() }}-900/30 dark:text-{{ $regStatus->color() }}-200">
                                             {{ $regStatus->label() ?? '—' }}
                                         </span>
                                     </td>
                                     <td class="px-4 py-3">
                                         <span
                                             class="text-xs px-2 py-1 rounded-full bg-{{ $regPaymentStatus->color() }}-100 text-{{ $regPaymentStatus->color() }}-700 dark:bg-{{ $regPaymentStatus->color() }}-900/30 dark:text-{{ $regPaymentStatus->color() }}-200">
                                             {{ $regPaymentStatus->label() ?? '—' }}
                                         </span>
                                     </td>
                                     <td class="px-4 py-3">
                                         <div class="flex gap-2">
                                             <x-button size="sm" icon="eye" wire:navigate
                                                 href="{{ route('admin.registrations.show', ['registration' => $reg->id]) }}"
                                                 label="{{ __('common.show') }}" />

                                         </div>
                                     </td>
                                 </tr>
                             @empty
                                 <tr>
                                     <td colspan="6" class="px-4 py-6 text-center text-sm text-secondary">
                                         {{ __('registration.no_registrations') }}
                                     </td>
                                 </tr>
                             @endforelse
                         </tbody>
                     </table>
                 </div>


                 <div class="flex justify-end mt-4">

                 </div>
             </div>
