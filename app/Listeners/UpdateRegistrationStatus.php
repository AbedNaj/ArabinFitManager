<?php

namespace App\Listeners;

use App\Enums\DebtStatusEnum;
use App\Enums\RegistrationPaymentStatusEnum;
use App\Events\PaymentCreated;
use App\Models\Tenants\Debt;
use App\Models\Tenants\Payment;
use App\Models\Tenants\Registration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateRegistrationStatus
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(PaymentCreated $event): void
    {

        $payment = $event->payment;

        $status = $this->getRegistrationStatus($payment->registration_id);

        if ($status) {

            Registration::wherekey($payment->registration_id)->update([
                'payment_status' => $status
            ]);
        }
    }

    public function getRegistrationStatus($registrationID)
    {

        $debt = Debt::where('registration_id', $registrationID)->value('status');
        if (!$debt) {
            return  RegistrationPaymentStatusEnum::PAID->value;
        }
        return match (true) {
            $debt == DebtStatusEnum::PAID->value => RegistrationPaymentStatusEnum::PAID->value,
            $debt == DebtStatusEnum::PARTIAL->value => RegistrationPaymentStatusEnum::PARTIAL->value,

            default => RegistrationPaymentStatusEnum::UNPAID->value
        };
    }
}
