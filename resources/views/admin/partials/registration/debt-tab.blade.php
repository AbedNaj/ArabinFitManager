 <div x-show="tab === 'debts'" x-transition class="p-4 sm:p-8">
     <div class="flex items-center justify-between mb-4">
         <h3 class="text-lg font-semibold">{{ __('debt.debts') }}</h3>
         <div class="flex gap-2">
             <x-button wire:navigate label="{{ __('debt.add_debt') }}" icon="plus"
                 href="{{ route('admin.debts.create', ['customer' => $customer->id]) }}" />
         </div>
     </div>

     <div class="overflow-x-auto rounded-xl border border-border">
         <table class="min-w-full divide-y divide-border">
             <thead class="bg-surface">
                 <tr>
                     <th class="px-4 py-3 text-start text-xs font-medium text-secondary">
                         {{ __('debt.debt_date') }}</th>
                     <th class="px-4 py-3 text-start text-xs font-medium text-secondary">
                         {{ __('debt.amount') }}</th>
                     <th class="px-4 py-3 text-start text-xs font-medium text-secondary">
                         {{ __('debt.paid') }}</th>
                     <th class="px-4 py-3 text-start text-xs font-medium text-secondary">
                         {{ __('debt.remaining') }}</th>
                     <th class="px-4 py-3 text-start text-xs font-medium text-secondary">
                         {{ __('common.status') }}</th>
                     <th class="px-4 py-3 text-start text-xs font-medium text-secondary">
                         {{ __('debt.notes') }}</th>
                     <th class="px-4 py-3 text-start text-xs font-medium text-secondary">
                         {{ __('debt.is_for_registration') }}</th>
                     <th class="px-4 py-3 text-start text-xs font-medium text-secondary">
                         {{ __('common.actions') }}</th>
                 </tr>
             </thead>
             <tbody class="divide-y divide-border bg-bg">

                 @forelse($debts ?? [] as $debt)
                     @php
                         $debtStatus = App\Enums\DebtStatusEnum::tryFrom($debt->status);
                         $remaining = $debt->amount - $debt->paid;
                     @endphp
                     <tr class="hover:bg-surface">
                         <td class="px-4 py-3 text-sm">{{ $debt->debt_date ?? '—' }}</td>
                         <td class="px-4 py-3 text-sm font-medium">{{ $debt->amount ?? '0.00' }}
                         </td>
                         <td class="px-4 py-3 text-sm">{{ $debt->paid ?? '0.00' }}</td>
                         <td class="px-4 py-3 text-sm">{{ $remaining ?? '0.00' }}</td>
                         <td class="px-4 py-3">
                             <span
                                 class="text-xs px-2 py-1 rounded-full bg-{{ $debtStatus->color() }}-100 text-{{ $debtStatus->color() }}-700 dark:bg-{{ $debtStatus->color() }}-900/30 dark:text-{{ $debtStatus->color() }}-200">
                                 {{ $debtStatus->label() }}
                             </span>
                         </td>
                         <td class="px-4 py-3 text-sm">{{ $debt->note ?? __('debt.no_notes') }}</td>
                         <td class="px-4 py-3 text-sm">
                             {{ $debt->registration_id ? __('common.yes') : __('common.no') }}</td>
                         <td class="px-4 py-3">
                             <div class="flex gap-2">
                                 @if (
                                     $debtStatus->value == App\Enums\DebtStatusEnum::PARTIAL->value ||
                                         $debtStatus->value == App\Enums\DebtStatusEnum::UNPAID->value)
                                     <x-button icon="banknotes" label="{{ __('debt.pay') }}" wire:navigate
                                         href="{{ route('admin.debts.update', ['debt' => $debt->id]) }}" primary />
                                 @endif

                             </div>
                         </td>
                     </tr>
                 @empty
                     <tr>
                         <td colspan="6" class="px-4 py-6 text-center text-sm text-secondary">
                             {{ __('debt.no_debts') }}
                         </td>
                     </tr>
                 @endforelse
             </tbody>
         </table>
     </div>


     <div class="flex justify-end mt-4">

     </div>


 </div>
