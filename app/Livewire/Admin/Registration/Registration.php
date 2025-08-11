<?php

namespace App\Livewire\Admin\Registration;

use App\Enums\CustomerStatusEnum;
use App\Enums\RegistrationStatusEnum;
use App\Models\Tenants\Customer;
use App\Models\Tenants\Plan;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Registration extends Component
{
    public $customerName, $customerID, $plans;

    public $plan, $planPrice, $planDuration;
    public $startDate, $endDate, $paid;
    public $currentDate;
    protected $rules = [
        'customerID' => 'required|exists:customers,id',
        'plan' => 'required|exists:plans,id',
        'startDate' => 'required|date',
        'endDate' => 'required|date',
    ];
    public function updatedPlan()
    {
        $planInfo = Plan::select('price', 'duration')->where('id', '=', $this->plan)->first()->toArray();

        $this->planPrice = $planInfo['price'];
        $this->planDuration = $planInfo['duration'];
        $this->calculateEndDate();
    }
    public function updatedStartDate()
    {
        $this->calculateEndDate();
    }

    public function calculateEndDate()
    {

        if ($this->planDuration && $this->startDate) {

            $this->endDate = Carbon::parse($this->startDate)
                ->addDays($this->planDuration + 1)
                ->format('Y-m-d');
        }
    }

    public function register()
    {
        $this->validate();
        $status = $this->checkRegistrationStatus($this->endDate, $this->startDate);
        $registration =  \App\Models\Tenants\Registration::create([
            'customer_id' => $this->customerID,
            'plan_id' => $this->plan,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'status' => $status

        ]);
        if ($registration) {
            Customer::where('id', $this->customerID)->update([
                'status' => $this->checkCustomerStatus($status),
            ]);
        }
        return redirect()->route('admin.registrations.index')->with('success', __('registration.registred') . ' ' . $this->customerName . ' ' . __('registration.successfully'));
    }

    public function checkRegistrationStatus($endDate, $startDate)
    {
        $todayDate = Carbon::today();
        $status = match (true) {
            $endDate < $todayDate => RegistrationStatusEnum::EXPIRED->value,
            $startDate > $todayDate => RegistrationStatusEnum::WAITING->value,
            default => RegistrationStatusEnum::ACTIVE->value,
        };

        return $status;
    }

    public function checkCustomerStatus($registrationStatus)
    {
        return match (true) {
            $registrationStatus == RegistrationStatusEnum::EXPIRED->value => CustomerStatusEnum::NOT_REGISTERED->value,

            default => CustomerStatusEnum::REGISTERED->value,
        };
    }
    public function mount() {}
    public function render()
    {
        return view('livewire.admin.registration.registration');
    }
}
