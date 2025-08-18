<div>


    <div class="bg-white shadow-sm rounded-xl border border-gray-100">

        <div class="px-4 sm:px-6 py-4 border-b border-gray-100">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>

                @if ($allowSearch)
                    <div class="flex items-center">
                        <x-input wire:model.live="search" placeholder="{{ __('common.search') }}" class="w-full sm:w-64" />
                    </div>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        @foreach ($columns as $column)
                            <th scope="col"
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                                {{ $column['label'] }}
                            </th>
                        @endforeach
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('common.actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($rows as $row)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            @foreach ($columns as $column)
                                <td class="px-4 sm:px-6 py-4 text-sm">
                                    @php
                                        $value = data_get($row, $column['field']) ?? __('common.no_data');
                                    @endphp

                                    @if (isset($column['enum']) && enum_exists($column['enum']))
                                        @php
                                            $enum = $column['enum']::tryFrom($value);
                                        @endphp

                                        @if ($enum)
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full
                                                bg-{{ $enum->color() }}-100 
                                                text-{{ $enum->color() }}-700
                                                border border-{{ $enum->color() }}-200">
                                                {{ $enum->label() }}
                                            </span>
                                        @else
                                            <span class="text-gray-900 break-words">{{ $value }}</span>
                                        @endif
                                    @else
                                        <span class="text-gray-900 break-words">{{ $value }}</span>
                                    @endif
                                </td>
                            @endforeach

                            <td class="px-4 sm:px-6 py-4 text-center">
                                <x-button href="{{ route($detailsRouteName, $row->id) }}" wire:navigate>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span class="hidden sm:inline">{{ __('common.details') }}</span>
                                </x-button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columns) + 1 }}" class="px-4 sm:px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
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


        @if ($rows->hasPages())
            <div class="px-4 sm:px-6 py-4 border-t border-gray-100">
                {{ $rows->links() }}
            </div>
        @endif
    </div>
</div>
