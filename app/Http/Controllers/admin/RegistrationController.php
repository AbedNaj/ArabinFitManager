<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CustomerStatusEnum;
use App\Enums\DebtStatusEnum;
use App\Enums\RegistrationStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Tenants\Registration;
use App\Http\Requests\Admin\Registration\StoreRegistrationRequest;
use App\Http\Requests\Admin\Registration\UpdateRegistrationRequest;
use App\Models\Tenants\Customer;
use App\Models\Tenants\Debt;
use App\Models\Tenants\Payment;
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
        $registration->load(['customer:id,name', 'debt:id,registration_id', 'plan:id,name,duration', 'payments:id,registration_id,amount,created_at']);

        $totalPaid = 0;


        foreach ($registration->payments as $item) {
            $totalPaid += $item->amount;
        }
        $remainingAmount = $registration->price_at_signup - $totalPaid;

        return view('admin.pages.registration.show', [
            'data'   => $registration,
            'totalPaid' =>  $totalPaid,
            'remainingAmount' => $remainingAmount
        ]);
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
        $registration->fill([
            'status' => RegistrationStatusEnum::STOPPED->value
        ]);

        if ($registration->isDirty()) {
            Customer::whereKey($registration->customer_id)->update([
                'status' => CustomerStatusEnum::NOT_REGISTERED->value
            ]);
            Debt::where('registration_id', '=', $registration->id)->delete();
            Payment::where('registration_id', '=', $registration->id)->delete();
            $registration->save();
            return redirect()->route('admin.registrations.show', ['registration' => $registration->id])->with('success', __('registration.cancel_success'));
        }
        return redirect()->route('admin.registrations.show', ['registration' => $registration->id])->with('error', __('registration.cancel_fail'));
    }
}
