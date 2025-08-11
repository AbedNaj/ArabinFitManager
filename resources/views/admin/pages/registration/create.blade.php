@extends('admin.layout.default')
@section('content')
    <section class="max-w-2xl mx-auto p-4 bg-bg rounded-md border border-border ">

        <div class="border-b border-border mb-4">
            <h1 class="text-2xl font-bold mb-4">{{ __('registration.title') }}</h1>
        </div>

        @livewire('admin.registration.registration', [
            'plans' => $plans,
            'customerID' => $customerID,
            'customerName' => $customerName,
        ])
    </section>
@endsection
