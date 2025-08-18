<?php

namespace App\Livewire\Admin\Debt;

use Livewire\Component;


class Filters extends Component
{
    public $debtStatus = null;

    public array $options = [];
    public $data;
    public function fetchData()
    {
        $this->data['status'] = $this->debtStatus;
    }
    public function updatedDebtStatus($value): void
    {
        $this->fetchData();

        $this->dispatch('debt:filtersChanged', data: $this->data);
    }
    public function render()
    {
        return view('livewire.admin.debt.filters');
    }
}
