<?php

namespace App\Livewire\Admin\Registration;

use Livewire\Component;
use Livewire\Attributes\Url;

class Filters extends Component
{
    public array $registrationOptions = [];
    public array $paymentOptions = [];



    public $paymentStatus = null;




    public $registrationStatus = null;

    public $data, $value;

    public function fetchData()
    {
        $this->data['status'] = $this->registrationStatus;
        $this->data['payment_status'] = $this->paymentStatus;
    }

    public function updatedRegistrationStatus($value): void
    {
        $this->fetchData();

        $this->dispatch('registrations:filtersChanged',  data: $this->data);
    }
    public function updatedPaymentStatus($value): void
    {

        $this->fetchData();

        $this->dispatch('registrations:filtersChanged',  data: $this->data);
    }
    public function render()
    {
        return view('livewire.admin.registration.filters');
    }
}
