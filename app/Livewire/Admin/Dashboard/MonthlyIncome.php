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
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount) as total')
        )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

        $this->monthLabels = $data->pluck('month')->toArray();

        $this->monthlyRevenue = $data->pluck('total')->toArray();
    }
    public function render()
    {
        return view('livewire.admin.dashboard.monthly-income');
    }
}
