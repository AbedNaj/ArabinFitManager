@extends('admin.layout.default')

@section('content')
    <livewire:admin.customer.profile :customer="$data" />
@endsection
