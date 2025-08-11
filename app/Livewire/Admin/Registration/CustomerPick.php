<?php

namespace App\Livewire\Admin\Registration;

use App\Enums\CustomerStatusEnum;
use App\Models\Tenants\Customer;
use App\Models\Tenants\Registration;
use Livewire\Component;

class CustomerPick extends Component
{
    public $customer;
    public $customerInfo, $registrationInfo;
    public $canRegister;

    public function updatedCustomer()
    {

        if ($this->customer) {
            $this->customerInfo = Customer::select('status', 'name')
                ->where('id', $this->customer)
                ->first()
                ->toArray();
            $this->canRegister = $this->customerCanRegister($this->customerInfo['status']);


            $this->registrationInfo = Registration::where('customer_id', $this->customer)
                ->latest()
                ->first(['start_date', 'end_date', 'status'])
                ?->toArray() ?? [];
        } else {
            $this->customerInfo = [];
            $this->registrationInfo = [];
        }
    }

    public function customerCanRegister($customerStatus)
    {
        return  $customerStatus == CustomerStatusEnum::REGISTERED->value ?  false : true;
    }


    public function render()
    {
        return view('livewire.admin.registration.customer-pick');
    }
}
