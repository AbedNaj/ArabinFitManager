@extends('admin.layout.default')
@section('content')
    <x-admin.head :href="route('admin.plans.create')" :label="__('plan.create')" />
    <livewire:admin.common.table listener="customerAdded" model="App\Models\Tenants\Plan" :columns="[
        ['field' => 'name', 'label' => __('plan.name')],
        ['field' => 'duration', 'label' => __('plan.duration')],
    ]" :title="__('plan.title')"
        detailsRouteName="admin.plans.show" />
@endsection
