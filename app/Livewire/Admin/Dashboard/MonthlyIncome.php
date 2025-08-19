<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Tenants\Payment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MonthlyIncome extends Component
{
    public $monthLabels = [], $monthlyRevenue = [];

    public function mount()
    {
        $data = Payment::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month_year"),
            DB::raw('SUM(amount) as total')
        )
            ->groupBy('month_year')
            ->orderBy('month_year', 'desc')
            ->limit(12)
            ->get();

        $this->monthLabels = $data->pluck('month_year')->toArray();
        $this->monthlyRevenue = $data->pluck('total')->toArray();
    }
    public function render()
    {
        return view('livewire.admin.dashboard.monthly-income');
    }
}
