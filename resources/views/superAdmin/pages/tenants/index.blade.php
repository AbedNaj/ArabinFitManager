@extends('superAdmin.layout.default')

@section('content')
    <x-superAdmin.head :href="route('gyms.create')"></x-superAdmin.head>
    <livewire:super-admin.common.table listener="categoryAdded" model="\App\Models\Tenant" :columns="[['field' => 'id', 'label' => 'اسم الشركه'], ['field' => 'domains.0.domain', 'label' => 'معرف الشركة']]" :with="['domains']"
        :title="__('gym.title')" :allowSearch="false" detailsRouteName="company.index" />
@endsection
