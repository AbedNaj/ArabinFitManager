@extends('admin.layout.default')
@section('content')
    <x-admin.head :href="route('admin.debts.create')" :label="__('debt.create')" />

    <div class="flex justify-between py-2">
        <div class="flex px-2 space-x-2">
            <livewire:admin.debt.filters :options="$debtStatus" />

        </div>
    </div>
    <livewire:admin.common.table listener="debt:filtersChanged" :allowedFilters="['status']" :with="['customer']"
        model="\App\Models\Tenants\Debt" :columns="[
            ['field' => 'debt_date', 'label' => __('debt.debt_date')],
            ['field' => 'customer.name', 'label' => __('debt.customer_name')],
            ['field' => 'amount', 'label' => __('debt.amount')],
            ['field' => 'paid', 'label' => __('debt.paid')],
            ['field' => 'status', 'label' => __('common.status'), 'enum' => 'App\Enums\DebtStatusEnum'],
        ]" :title="__('registration.title')" searchFieldWith="customer" orderBy="debt_date"
        detailsRouteName="admin.debts.show" />
@endsection
