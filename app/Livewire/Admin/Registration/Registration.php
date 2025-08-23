<?php

namespace App\Livewire\Admin\Registration;

use App\Enums\CustomerStatusEnum;
use App\Enums\DebtStatusEnum;
use App\Enums\RegistrationPaymentStatusEnum;
use App\Enums\RegistrationStatusEnum;
use App\Models\Tenants\Customer;
use App\Models\Tenants\Debt;
use App\Models\Tenants\Payment;
use App\Models\Tenants\Plan;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Registration extends Component
{
    public $customerName, $customerID, $plans;

    public $plan, $planPrice, $planDuration;
    public $startDate, $endDate, $paid_amount = 0;
    public $currentDate;
    protected $rules = [
        'customerID' => 'required|exists:customers,id',
        'plan' => 'required|exists:plans,id',
        'startDate' => 'required|date',
        'endDate' => 'required|date',
        'paid_amount' => 'min:0|numeric'
    ];
    public function updatedPlan()
    {
        $planInfo = Plan::select('price', 'duration')->where('id', '=', $this->plan)->first()->toArray();

        $this->planPrice = $planInfo['price'];
        $this->planDuration = $planInfo['duration'];
        $this->calculateEndDate();
    }
    public function updatedStartDate($value)
    {

        $this->calculateEndDate();
    }

    public function calculateEndDate()
    {

        if ($this->planDuration && $this->startDate) {

            $this->endDate = Carbon::parse($this->startDate)
                ->addDays($this->planDuration)
                ->format('Y-m-d');
        }
    }

    public function register()
    {

        $this->validate();
        $this->checkPaidAmountValidation();
        $status = $this->checkRegistrationStatus($this->endDate, $this->startDate);
        $registration =  \App\Models\Tenants\Registration::create([
            'customer_id' => $this->customerID,
            'plan_id' => $this->plan,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'status' => $status,
            'price_at_signup' => $this->planPrice,


        ]);
        if ($registration) {
            Customer::where('id', $this->customerID)->update([
                'status' => $this->checkCustomerStatus($status),
            ]);

            $this->handleRegistrationPayment($registration->id);
        }
        return redirect()->route('admin.customers.show', ['customer' => $this->customerID])->with('success', __('registration.registred') . ' ' . $this->customerName . ' ' . __('registration.successfully'));
    }

    public function checkRegistrationStatus($endDate, $startDate)
    {
        $todayDate = Carbon::today();
        $status = match (true) {
            $endDate <= $todayDate => RegistrationStatusEnum::EXPIRED->value,
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

    public function handleRegistrationPayment($registrationID)
    {

        $pymentStatus = match (true) {
            $this->paid_amount == $this->planPrice => RegistrationPaymentStatusEnum::PAID->value,
            $this->paid_amount == 0 => RegistrationPaymentStatusEnum::UNPAID->value,
            $this->paid_amount < $this->planPrice => RegistrationPaymentStatusEnum::PARTIAL->value,
        };

        \App\Models\Tenants\Registration::where('id', $registrationID)->update([
            'payment_status' => $pymentStatus
        ]);

        if ($this->paid_amount > 0) {

            Payment::create([
                'customer_id' => $this->customerID,
                'registration_id' => $registrationID,
                'amount' => $this->paid_amount,

            ]);
        }

        if ($pymentStatus !== RegistrationPaymentStatusEnum::PAID->value) {
            $debtValue = $this->planPrice - $this->paid_amount;
            Debt::create([
                'customer_id' => $this->customerID,
                'registration_id' => $registrationID,
                'amount' => $debtValue,
                'paid' => $this->paid_amount,
                'status' => DebtStatusEnum::UNPAID->value,
                'debt_date' => $this->startDate
            ]);
        }
    }
    public function checkPaidAmountValidation()
    {
        if ($this->paid_amount > $this->planPrice) {
            throw ValidationException::withMessages(['paid_amount' => __('registration.paid_amount_fail_message')]);
        }
    }

    public function mount()
    {
        $this->startDate = now()->toDateString();
    }
    public function render()
    {
        return view('livewire.admin.registration.registration');
    }
}
