@extends('superAdmin.layout.default')

@section('content')
    <section class="max-w-2xl mx-auto p-4 bg-bg rounded-md border border-border ">
        <h1 class="text-2xl font-bold mb-4">{{ __('gym.create') }}</h1>

        <form action="{{ route('gyms.store') }}" method="post" class="space-x-0 px-2 space-y-4">
            @csrf

            <div class="flex space-x-2">
                <x-input name="name" label="{{ __('gym.name') }}" />
                <x-input name="tenant_id" label="{{ __('gym.tenant_id') }}"
                    description="{{ __('gym.tenant_id_description') }}" />

            </div>
            <div class="flex space-x-2">
                <x-input name="owner_name" label="{{ __('gym.owner_name') }}" />
                <x-input name="phone" label="{{ __('gym.phone') }}" />
            </div>
            <div class="flex space-x-2">
                <x-input name="location" label="{{ __('gym.location') }}" />
                <x-password type="password" name="password" description="{{ __('gym.password_description') }}"
                    label="{{ __('gym.password') }}" />
            </div>

            <div class="mt-2">
                <x-button type="submit" label="{{ __('gym.submit') }}" />
            </div>
        </form>
    </section>
@endsection
