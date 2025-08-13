@extends('admin.layout.default')
@section('content')
    @livewire('admin.registration.customer-pick')


    <livewire:admin.common.table listener="customerAdded" :with="['customer', 'plan']" model="\App\Models\Tenants\Registration"
        :columns="[
            ['field' => 'customer.name', 'label' => __('registration.customer_name')],
            ['field' => 'plan.name', 'label' => __('registration.plan_name')],
            ['field' => 'start_date', 'label' => __('registration.start_date')],
            ['field' => 'end_date', 'label' => __('registration.end_date')],
            ['field' => 'status', 'label' => __('registration.status'), 'enum' => 'App\Enums\RegistrationStatusEnum'],
            [
                'field' => 'payment_status',
                'label' => __('registration.payment_status'),
                'enum' => 'App\Enums\RegistrationPaymentStatusEnum',
            ],
        ]" searchFieldWith="customer" :title="__('registration.title')" detailsRouteName="admin.registrations.show" />
@endsection
