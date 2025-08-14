@extends('admin.layout.default')

@section('content')
    <div class="max-w-7xl mx-auto px-4">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold">{{ __('dashboard.title') }}</h1>

            </div>
            <div class="flex items-center gap-2">

            </div>
        </div>



        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

            <x-admin.card :data="$activeRegistrations" :icon="view('components.icons.users')" :title="__('dashboard.active_subscriptions')">

            </x-admin.card>

            <x-admin.card :data="$expiredToday" :icon="view('components.icons.expired')" iconColor="red" :title="__('dashboard.expired_today')" :subData="$expiredTotal"
                :subTitle="__('dashboard.total_expired')">

            </x-admin.card>
            <x-admin.card :currency="true" :data="$currentIncome" :icon="view('components.icons.income')" iconColor="blue" :title="__('dashboard.mtd_revenue')">

            </x-admin.card>

            <x-admin.card :currency="true" :data="$outstandingDebts" :icon="view('components.icons.warning')" iconColor="purple" :title="__('dashboard.outstanding_debt')">

            </x-admin.card>


        </div>




        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

            <div class="bg-bg p-5 rounded-2xl border border-border">
                @livewire('admin.dashboard.monthly-income')
            </div>


            <div class="bg-bg p-5 rounded-2xl border border-border">
                @livewire('admin.dashboard.monthly-registrations')
            </div>
        </div>


    </div>
@endsection
