<?php

namespace App\Livewire\Admin\Debt;

use App\Enums\DebtStatusEnum;
use App\Models\Tenants\Customer;
use App\Models\Tenants\Debt;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Create extends Component
{
    public $customer, $notForCustomer;

    public $customerInfo;

    public $debtsAmount = 0, $paidAmount = 0, $hasDebts = false, $paidPercentage = 100, $remainingAmount = 0;

    public $debtDate, $debt_amount = 0, $paid_amount = 0, $note;

    protected $rules = [
        'customer' => 'nullable|exists:customers,id',
        'debtDate' => 'required|date',
        'debt_amount' => 'min:1|numeric',
        'paid_amount' => 'min:1|numeric',
        'note' => 'nullable|string|max:1000'
    ];
    public function updatedCustomer()
    {

        $this->reset('customerInfo');

        $this->customerInfo = Customer::select('id', 'name')->where('id', $this->customer)->with(['debts:id,customer_id,amount,paid,status,debt_date'])->first();

        $this->handleCustomerDebts();
    }

    public function updatedNotForCustomer($value)
    {

        if ($this->notForCustomer == true) {

            $this->reset(['customer', 'customerInfo']);
        }
    }
    public function handleCustomerDebts()
    {
        $this->reset([
            'debtsAmount',
            'paidAmount',
            'hasDebts',
            'paidPercentage',
            'remainingAmount',
        ]);

        if (!empty($this->customerInfo->debts) && count($this->customerInfo->debts) > 0) {

            foreach ($this->customerInfo->debts as $debt) {
                $this->debtsAmount += $debt->amount;
                $this->paidAmount +=  $debt->paid;
            }
            $this->hasDebts =  $this->debtsAmount  ==  $this->paidAmount ? false : true;
            $this->paidPercentage = $this->debtsAmount > 0
                ? ($this->paidAmount / $this->debtsAmount) * 100
                : 0;
            $this->remainingAmount = $this->debtsAmount - $this->paidAmount;
        }
    }
    public function checkDebtStatus()
    {
        return match (true) {
            $this->paid_amount == 0 => DebtStatusEnum::UNPAID->value,
            $this->debt_amount == $this->paid_amount  => DebtStatusEnum::PAID->value,
            default => DebtStatusEnum::PARTIAL->value,
        };
    }
    public function create()
    {

        $this->validate();
        if ($this->paid_amount > $this->debt_amount) {
            throw ValidationException::withMessages(['paid_amount' => __('debt.paid_amount_error')]);
        }

        $status = $this->checkDebtStatus();

        Debt::create([
            'customer_id' => $this->customer,
            'amount' => $this->debt_amount,
            'paid' => $this->paid_amount,
            'status' => $status,
            'debt_date' => $this->debtDate,
            'note' => $this->note
        ]);

        return redirect()->route('admin.debts.index')->with('success', __('debt.create_success'));
    }
    public function mount()
    {
        $this->debtDate = now()->toDateString();
    }
    public function render()
    {
        return view('livewire.admin.debt.create');
    }
}
