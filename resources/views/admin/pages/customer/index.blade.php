@extends('admin.layout.default')
@section('content')
    <x-admin.head :href="route('admin.customers.create')" :label="__('customer.create')" />

    <livewire:admin.customer.filters :options="$customerOptions" />
    <livewire:admin.common.table listener="customer:filtersChanged" model="\App\Models\Tenants\Customer" :columns="[
        ['field' => 'name', 'label' => __('customer.name')],
        ['field' => 'phone', 'label' => __('customer.phone')],
        ['field' => 'status', 'label' => __('customer.status'), 'enum' => 'App\Enums\CustomerStatusEnum'],
    ]"
        :title="__('customer.title')" detailsRouteName="admin.customers.show" />
@endsection
