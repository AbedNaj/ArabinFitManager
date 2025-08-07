@extends('admin.layout.default')
@section('content')
    <div x-data="{ editMode: false }" class="min-h-screen bg-gradient-to-br from-bg to-surface py-4 sm:py-8">
        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-bg rounded-2xl shadow-xl border border-border mb-6 sm:mb-8 overflow-hidden">
                <div
                    class="bg-gradient-to-r from-primary to-indigo-600 dark:from-primary dark:to-purple-600 px-4 sm:px-8 py-4 sm:py-6">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-4 sm:space-y-0">
                        <div class="text-white">
                            <template x-if="!editMode">
                                <div>
                                    <h1 class="text-xl sm:text-2xl font-bold mb-1">{{ $data->name }}</h1>
                                    <p class="text-blue-100 dark:text-purple-100 text-sm">
                                        {{ __('plan.show_plan_info') }}</p>
                                </div>
                            </template>
                            <template x-cloak x-if="editMode">
                                <div>
                                    <h1 class="text-xl sm:text-2xl font-bold mb-1">{{ $data->name }}
                                    </h1>
                                    <p class="text-blue-100 dark:text-purple-100 text-sm">{{ __('plan.edit_plan_info') }}
                                    </p>
                                </div>
                            </template>
                        </div>

                        <div class="flex space-x-2 rtl:space-x-reverse">
                            <x-button label="{{ __('common.edit_data') }}" x-show="!editMode" @click="editMode = !editMode"
                                class="bg-white/20 dark:bg-white/10 backdrop-blur-sm text-white border-white/20 hover:bg-white/30 dark:hover:bg-white/20 hover:border-white/40 transition-all duration-300" />
                            <x-button x-cloak label="{{ __('common.edit_cancel') }}" x-show="editMode"
                                @click="editMode = !editMode"
                                class="bg-white/20 dark:bg-white/10 backdrop-blur-sm text-white border-white/20 hover:bg-white/30 dark:hover:bg-white/20 hover:border-white/40 transition-all duration-300" />
                        </div>
                    </div>
                </div>
            </div>


            <div class="bg-bg rounded-2xl shadow-xl border border-border overflow-hidden">

                <div x-show="!editMode" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="p-4 sm:p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                            <x-admin.show-read-only :label="__('plan.name')" :icon="view('components.icons.white.plan')">
                                {{ $data->name }}</x-admin.show-read-only>



                            <x-admin.show-read-only :label="__('plan.duration')" :icon="view('components.icons.white.duration')">
                                {{ $data->duration }} {{ __('plan.days') }}</x-admin.show-read-only>
                        </div>
                    </div>
                </div>


                <div x-cloak x-show="editMode" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="p-4 sm:p-8">
                        <form action="{{ route('admin.plans.update', ['plan' => $data->id]) }}" method="POST"
                            class="space-y-6">
                            @csrf
                            @method('PATCH')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                                <div class="space-y-2">
                                    <x-input name="name" value="{{ old('name', $data->name) }}"
                                        label="{{ __('plan.name') }}" />

                                </div>

                                <div class="space-y-2">

                                    <x-input type="number" name="duration" value="{{ old('phone', $data->duration) }}"
                                        label="{{ __('plan.duration') }}" />
                                </div>
                            </div>


                            <div class="flex justify-end pt-6 border-t border-border dark:border-border">
                                <x-button type="submit" label="{{ __('common.save_changes') }}"
                                    class="px-6 sm:px-8 py-3 bg-gradient-to-r from-primary to-indigo-600 dark:from-primary dark:to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-600 hover:to-indigo-700 dark:hover:from-purple-600 dark:hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2 rtl:space-x-reverse">

                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Custom scrollbar with theme support */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--color-surface);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--color-border);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--color-secondary);
        }

        /* Enhanced RTL support */
        [dir="rtl"] .space-x-3> :not([hidden])~ :not([hidden]) {
            margin-left: 0;
            margin-right: 0.75rem;
        }

        [dir="rtl"] .space-x-2> :not([hidden])~ :not([hidden]) {
            margin-left: 0;
            margin-right: 0.5rem;
        }

        /* Responsive text sizing */
        @media (max-width: 640px) {
            .text-lg {
                font-size: 1rem;
                line-height: 1.5rem;
            }
        }

        /* Enhanced focus states */
        .focus\:ring-primary\/20:focus {
            --tw-ring-color: rgb(var(--color-primary) / 0.2);
        }

        .focus\:ring-accent\/20:focus {
            --tw-ring-color: rgb(var(--color-accent) / 0.2);
        }

        /* Smooth transitions for theme changes */
        * {
            transition-property: background-color, border-color, color, fill, stroke;
            transition-duration: 200ms;
            transition-timing-function: ease-in-out;
        }

        /* Enhanced mobile spacing */
        @media (max-width: 768px) {
            .grid-cols-1 {
                gap: 1rem;
            }
        }
    </style>
@endsection
