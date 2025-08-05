<div>
    <div class="bg-bg p-5 rounded-xl border border-border">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold">{{ $title }}</h3>

            @if ($allowSearch)
                <div class="flex items-center space-x-2">

                    <x-input wire:model.live="search" placeholder="{{ __('common.search') }}" />
                </div>
            @endif

        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-sm text-secondary border-b border-border">
                        @foreach ($columns as $column)
                            <th class="pb-3 whitespace-nowrap">
                                {{ __('common.' . $column['label']) }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($rows as $row)
                        <tr>
                            @foreach ($columns as $column)
                                <td class="py-3 whitespace-nowrap">
                                    @php
                                        $value = data_get($row, $column['field']);
                                    @endphp

                                    @if (isset($column['enum']) && enum_exists($column['enum']))
                                        @php
                                            $enum = $column['enum']::tryFrom($value);
                                        @endphp

                                        @if ($enum)
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full shadow-sm
                                                bg-{{ $enum->color() }}-100 
                                                text-{{ $enum->color() }}-800
                                                border border-{{ $enum->color() }}-200">
                                                {{ $enum->label() }}
                                            </span>
                                        @else
                                            <span class="text-slate-700">{{ $value }}</span>
                                        @endif
                                    @else
                                        <span class="text-slate-700">{{ $value }}</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columns) }}" class="text-center py-4 text-secondary">
                                {{ __('common.no_data') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $rows->links() }}
        </div>
    </div>
</div>
