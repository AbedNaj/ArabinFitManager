<?php

namespace App\Livewire\Admin\Dashboard;

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
            DB::raw('YEAR(start_date) as year'),
            DB::raw('MONTH(start_date) as month'),
            DB::raw('count(id) as total')
        )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

        $this->monthLabels = $data->pluck('month')->toArray();

        $this->monthlyRegistrations = $data->pluck('total')->toArray();
    }
    public function render()
    {
        return view('livewire.admin.dashboard.monthly-registrations');
    }
}
