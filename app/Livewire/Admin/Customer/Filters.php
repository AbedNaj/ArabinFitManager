<?php

namespace App\Livewire\Admin\Customer;

use Livewire\Component;

class Filters extends Component
{

    public $customerStatus = null;

    public array $options = [];
    public $data;
    public function fetchData()
    {
        $this->data['status'] = $this->customerStatus;
    }
    public function updatedCustomerStatus(): void
    {
        $this->fetchData();

        $this->dispatch('customer:filtersChanged', data: $this->data);
    }
    public function render()
    {
        return view('livewire.admin.customer.filters');
    }
}
