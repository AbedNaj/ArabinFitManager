<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CustomerStatusEnum;
use App\Http\Controllers\Controller;


use App\Models\Tenants\Customer;
use App\Http\Requests\Admin\Customer\StoreCustomerRequest;
use App\Http\Requests\Admin\Customer\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customerOptions = collect(CustomerStatusEnum::cases())->map(fn($case) => [
            'name' => $case->label(),
            'id' => $case->value,
        ])->toArray();

        return view(
            'admin.pages.customer.index',
            [

                'customerOptions' => $customerOptions
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {

        $validated = $request->validated();

        $customer =  Customer::create($validated);
        if ($validated['register']) {
            return redirect()->route('admin.registrations.create', ['customer' => $customer->id])->with('success', __('customer.create_success'));
        }
        return redirect()->route('admin.customers.index')->with('success', __('customer.create_success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('admin.pages.customer.show', ['data'   => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $validated = $request->validated();

        $customer->fill([
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
        ]);
        if ($customer->isDirty()) {
            $customer->save();
            return redirect()->route('admin.customers.index')->with('success', __('common.update_success'));
        }
        return redirect()->back()->with('warning', __('common.no_changes'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
