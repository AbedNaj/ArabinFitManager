<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Registration;
use App\Http\Requests\Admin\Registration\StoreRegistrationRequest;
use App\Http\Requests\Admin\Registration\UpdateRegistrationRequest;
use App\Models\Tenants\Customer;
use App\Models\Tenants\Plan;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.registration.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $customerID = $request->input('customer');

        if (!$customerID || ! Customer::where('id', $customerID)->exists()) {
            abort(404);
        }

        $customerName = Customer::where('id', '=', $customerID)->value('name');
        $plans = Plan::select('id', 'name')->get()->toArray();


        return view(
            'admin.pages.registration.create',
            [
                'customerName' => $customerName,
                'customerID' => $customerID,
                'plans' => $plans
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegistrationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Registration $registration)
    {
        $registration->load(['customer:id,name', 'plan:id,name,duration']);
        return view('admin.pages.registration.show', ['data'   => $registration]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegistrationRequest $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registration $registration)
    {
        //
    }
}
