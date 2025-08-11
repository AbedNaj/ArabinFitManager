  <section class="flex flex-col gap-4">
      <div class="flex items-center justify-between mb-4">


          <x-button lg label="{{ __('registration.create') }}" x-on:click="$openModal('cardModal')" primary />

          <x-modal-card title="{{ __('registration.pick_customer') }}" name="cardModal">

              <div class="space-y-3">
                  <div class="rounded-lg border border-dashed border-border bg-surface/60 p-4">
                      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                          <x-select class="min-w-full" label="{{ __('registration.select_customer') }}"
                              wire:model.live="customer" placeholder="{{ __('registration.select_a_customer') }}"
                              :async-data="route('api.customers.index')" option-label="name" option-value="id" />
                      </div>
                  </div>

                  @if (!empty($customerInfo))
                      @php

                          $name = trim((string) ($customerInfo['name'] ?? ''));
                          $parts = preg_split('/\s+/u', $name, -1, PREG_SPLIT_NO_EMPTY);
                          $initials = '';
                          if (!empty($parts)) {
                              $initials .= mb_substr($parts[0], 0, 1);
                              if (isset($parts[1])) {
                                  $initials .= mb_substr($parts[1], 0, 1);
                              }
                          }
                          $initials = mb_strtoupper($initials, 'UTF-8');

                          $status = App\Enums\CustomerStatusEnum::tryFrom($customerInfo['status'] ?? '');

                          $registrationStatus = App\Enums\RegistrationStatusEnum::tryFrom(
                              $registrationInfo['status'] ?? '',
                          );
                          $badgePalette = [
                              'green' =>
                                  'bg-emerald-100 text-emerald-700 border border-emerald-200 dark:bg-emerald-900/20 dark:text-emerald-300 dark:border-emerald-800/30',
                              'red' =>
                                  'bg-rose-100 text-rose-700 border border-rose-200 dark:bg-rose-900/20 dark:text-rose-300 dark:border-rose-800/30',
                              'blue' =>
                                  'bg-sky-100 text-sky-700 border border-sky-200 dark:bg-sky-900/20 dark:text-sky-300 dark:border-sky-800/30',
                              'gray' =>
                                  'bg-slate-100 text-slate-700 border border-slate-200 dark:bg-slate-900/20 dark:text-slate-300 dark:border-slate-800/30',
                          ];
                          $badgeClass = $badgePalette[$status?->color() ?? 'gray'] ?? $badgePalette['gray'];

                      @endphp


                      <div class="rounded-xl border border-border bg-bg p-5 shadow-sm">
                          <div class="flex items-start justify-between gap-4">
                              <div class="flex items-center gap-3">

                                  <div
                                      class="flex h-12 w-12 items-center justify-center rounded-full bg-surface text-base font-bold text-primary">
                                      {{ $initials ?: '??' }}
                                  </div>

                                  <div>
                                      <div class="text-xs text-secondary">{{ __('registration.customer_name') }}</div>
                                      <div class="text-lg font-semibold text-text">{{ $customerInfo['name'] }}</div>
                                  </div>
                              </div>


                              <span
                                  class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium {{ $badgeClass }}">
                                  {{ $status?->label() }}
                              </span>
                          </div>

                          <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-3">
                              <div class="rounded-lg bg-surface p-3">
                                  <div class="flex items-center gap-2 text-xs text-secondary">
                                      <x-icon name="calendar" class="h-4 w-4" />
                                      {{ __('registration.start_date') }}
                                  </div>
                                  <div class="mt-1 font-medium text-text">
                                      {{ $registrationInfo['start_date'] ?? 'N/A' }}
                                  </div>
                              </div>

                              <div class="rounded-lg bg-surface p-3">
                                  <div class="flex items-center gap-2 text-xs text-secondary">
                                      <x-icon name="calendar" class="h-4 w-4" />
                                      {{ __('registration.end_date') }}
                                  </div>
                                  <div class="mt-1 font-medium text-text">
                                      {{ $registrationInfo['end_date'] ?? 'N/A' }}
                                  </div>
                              </div>

                              <div class="rounded-lg bg-surface p-3">
                                  <div class="flex items-center gap-2 text-xs text-secondary">
                                      <x-icon name="check-circle" class="h-4 w-4" />
                                      {{ __('registration.status') }}
                                  </div>
                                  <div class="mt-1">
                                      @php

                                      @endphp
                                      <span
                                          class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium
                                           bg-{{ $registrationStatus?->color() }}-100 text-{{ $registrationStatus?->color() }}-700 border border-{{ $registrationStatus?->color() }}-200 dark:bg-{{ $registrationStatus?->color() }}-900/20 dark:text-{{ $registrationStatus?->color() }}-300 dark:border-{{ $registrationStatus?->color() }}-800/30">
                                          {{ $registrationStatus?->label() ?? 'N/A' }}
                                      </span>
                                  </div>
                              </div>
                          </div>

                      </div>
                  @endif
              </div>


              <x-slot name="footer" class="flex justify-between gap-x-4">
                  <div class="flex items-center gap-2">
                      @if (!empty($customerInfo) && $canRegister == true)
                          <x-button wire:navigate
                              href="{{ route('admin.registrations.create', ['customer' => $customer]) }}" primary
                              label="{{ __('registration.register') }}" />
                      @endif


                      <x-button flat label="{{ __('common.cancel') }}" x-on:click="close" />
                  </div>
              </x-slot>
          </x-modal-card>



      </div>

  </section>
