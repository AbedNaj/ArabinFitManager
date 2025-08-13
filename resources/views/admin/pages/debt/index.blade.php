@extends('admin.layout.default')
@section('content')
    <x-admin.head :href="route('admin.debts.create')" :label="__('debt.create')" />


    <livewire:admin.common.table listener="customerAdded" :with="['customer']" model="\App\Models\Tenants\Debt" :columns="[
        ['field' => 'debt_date', 'label' => __('debt.debt_date')],
        ['field' => 'customer.name', 'label' => __('debt.customer_name')],
        ['field' => 'amount', 'label' => __('debt.amount')],
        ['field' => 'paid', 'label' => __('debt.paid')],
        ['field' => 'status', 'label' => __('common.status'), 'enum' => 'App\Enums\DebtStatusEnum'],
    ]"
        :title="__('registration.title')" searchFieldWith="customer" detailsRouteName="admin.debts.show" />
@endsection
