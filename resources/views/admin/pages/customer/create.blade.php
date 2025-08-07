@extends('admin.layout.default')
@section('content')
    <section class="max-w-2xl mx-auto p-4 bg-bg rounded-md border border-border ">

        <div class="border-b border-border mb-4">
            <h1 class="text-2xl font-bold mb-4">{{ __('customer.create_title') }}</h1>
        </div>

        <form action="{{ route('admin.customers.store') }}" method="post" class="space-x-0 px-2 space-y-4">
            @csrf


            <x-input name="name" label="{{ __('customer.name') }}" />
            <x-input name="phone" label="{{ __('customer.phone') }}" />



            <div class="mt-2">
                <x-button type="submit" label="{{ __('common.create') }}" />
                <x-button wire:navigate href="{{ route('admin.customers.index') }}" label="{{ __('common.cancel') }}"
                    outline hover="warning" focus:solid.gray />

            </div>
        </form>
    </section>
@endsection
