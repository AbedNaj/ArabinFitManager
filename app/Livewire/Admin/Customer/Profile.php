<?php

namespace App\Livewire\Admin\Customer;

use App\Enums\CustomerStatusEnum;
use App\Models\Tenants\Customer;
use App\Models\Tenants\Debt;
use App\Models\Tenants\Registration;
use Livewire\Component;
use Livewire\WithPagination;

class Profile extends Component
{
    use WithPagination;
    public $debts = [], $registrations = [];
    public Customer $customer;

    public $debtsAmount = 0, $paidAmount = 0, $hasDebts = false, $remainingAmount = 0;
    public $currentRegistration, $canRegister;




    public function getCurrentRegistration()
    {
        $this->currentRegistration = Registration::select('id', 'customer_id', 'plan_id', 'start_date', 'end_date', 'status')
            ->where('customer_id', '=', $this->customer['id'])->with('plan:id,name')->first();

        $this->canRegister = $this->customerCanRegister($this->customer->status);
    }
    public function customerCanRegister($customerStatus)
    {
        return  $customerStatus == CustomerStatusEnum::REGISTERED->value ?  false : true;
    }
    public function getDebtData()
    {
        if (!empty($this->customer->debts) && count($this->customer->debts) > 0) {

            foreach ($this->customer->debts as $debt) {
                $this->debtsAmount += $debt->amount;
                $this->paidAmount +=  $debt->paid;
            }
            $this->hasDebts =  $this->debtsAmount  ==  $this->paidAmount ? false : true;

            $this->remainingAmount = $this->debtsAmount - $this->paidAmount;
        }
    }
    public function getRegistrationInfo()
    {
        if (empty($this->registrations)) {

            $this->registrations = Registration::select('id', 'plan_id', 'start_date', 'end_date', 'status', 'payment_status')
                ->where('customer_id', '=', $this->customer->id)->orderbydesc('start_date')->with('plan:id,name')->get();
        }
    }
    public function getDebtInfo()
    {
        if (empty($this->debts)) {

            $this->debts = Debt::select('id', 'amount', 'paid', 'note', 'status', 'debt_date', 'registration_id')
                ->where('customer_id', '=', $this->customer->id)->orderbydesc('debt_date')->get();
        }
    }
    public function mount()
    {
        $this->getCurrentRegistration();
        $this->getDebtData();
    }
    public function render()
    {
        return view('livewire.admin.customer.profile');
    }
}
