<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DebtStatusEnum;
use App\Events\PaymentCreated;
use App\Http\Controllers\Controller;
use App\Models\Tenants\Debt;
use App\Http\Requests\Admin\Debt\StoreDebtRequest;
use App\Http\Requests\Admin\Debt\UpdateDebtRequest;
use App\Models\Tenants\Payment;
use Illuminate\Validation\ValidationException;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $debtStatus = collect(DebtStatusEnum::cases())
            ->map(fn($case) => [
                'name' => $case->label(),
                'id' => $case->value,
            ])
            ->toArray();
        return view('admin.pages.debt.index', [
            'debtStatus' => $debtStatus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.debt.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDebtRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Debt $debt)
    {
        $debt->load(['customer:id,name', 'registration:id,start_date,end_date', 'payments:id,debt_id,amount,created_at']);

        return view('admin.pages.debt.show', ['data' => $debt]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Debt $debt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDebtRequest $request, Debt $debt)
    {

        $validated = $request->validated();

        if ($validated['paid_amount'] > $validated['remaining_amount']) {
            throw ValidationException::withMessages(['paid_amount' => __('debt.payment_validation')]);
        }
        $status = $request->getDebtStatus($validated['paid_amount'], $validated['remaining_amount']);
        $debt->fill([
            'paid' => $debt['paid'] + $validated['paid_amount'],
            'status' => $status
        ]);

        if ($debt->isDirty()) {
            $payment = Payment::create([
                'customer_id' => $debt->customer_id,
                'registration_id' => $debt->registration_id,
                'debt_id' => $debt->id,
                'amount' => $validated['paid_amount']
            ]);


            $debt->save();
            event(new PaymentCreated($payment));
            return redirect()->route('admin.debts.show', ['debt' => $debt])->with('success', __('debt.payment_successful'));
        }
        return redirect()->route('admin.debts.show', ['debt' => $debt])->with('error', __('debt.payment_fail'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Debt $debt)
    {
        $debt->fill([
            'status' => DebtStatusEnum::CANCELLED->value,
            'paid' => 0
        ]);

        if ($debt->isDirty()) {


            Payment::where('debt_id', '=', $debt->id)->delete();
            $debt->save();
            return redirect()->route('admin.debts.show', ['debt' => $debt->id])->with('success', __('debt.cancel_success'));
        }
        return redirect()->route('admin.debts.show', ['debt' => $debt->id])->with('error', __('debt.cancel_fail'));
    }
}
