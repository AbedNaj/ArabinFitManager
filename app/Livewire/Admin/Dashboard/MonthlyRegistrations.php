<?php

namespace App\Livewire\Admin\Dashboard;

use App\Enums\RegistrationStatusEnum;
use App\Models\Tenants\Registration;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MonthlyRegistrations extends Component
{
    public $monthLabels = ['jan', 'feb', 'march'], $monthlyRegistrations = [1, 80, 30];
    public $limit = 12;
    public function mount()
    {
        $data = Registration::select(
            DB::raw("DATE_FORMAT(start_date, '%Y-%m') as month_year"),
            DB::raw('count(id) as total')
        )

            ->groupBy('month_year')
            ->orderBy('month_year', 'desc')
            ->where('status', '!=', RegistrationStatusEnum::STOPPED)
            ->limit(12)
            ->get();

        $this->monthLabels = $data->pluck('month_year')->toArray();

        $this->monthlyRegistrations = $data->pluck('total')->toArray();
    }
    public function render()
    {
        return view('livewire.admin.dashboard.monthly-registrations');
    }
}
