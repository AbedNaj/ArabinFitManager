@extends('admin.layout.default')
@section('content')
    <x-admin.head :href="route('admin.customers.create')" :label="__('customer.create')" />
    <livewire:admin.common.table listener="customerAdded" model="\App\Models\Tenants\Customer" :columns="[
        ['field' => 'name', 'label' => __('customer.name')],
        ['field' => 'phone', 'label' => __('customer.phone')],
    ]"
        :title="__('customer.title')" detailsRouteName="admin.customers.show" />
@endsection
