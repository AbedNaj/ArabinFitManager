<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DebtStatusEnum;
use App\Enums\RegistrationStatusEnum;

use App\Models\Tenants\Debt;
use App\Models\Tenants\Payment;
use App\Models\Tenants\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request)
  {

    $expiredRegistrations = Registration::select('id', 'status', 'end_date')->where('status', '=', RegistrationStatusEnum::EXPIRED->value);
    $expiredTotal = (clone $expiredRegistrations)->count('id');
    $expiredToday = (clone $expiredRegistrations)
      ->whereDay('end_date', Carbon::now()->day)
      ->count('id');



    $activeRegistrations = Registration::where('status', '=', RegistrationStatusEnum::ACTIVE->value)->count('id');



    $currentIncome = Payment::whereMonth('created_at', Carbon::now()->month)
      ->whereYear('created_at', Carbon::now()->year)
      ->sum('amount');

    $outstandingDebts = Debt::whereIn('status', [
      DebtStatusEnum::UNPAID->value,
      DebtStatusEnum::PARTIAL->value
    ])
      ->selectRaw('SUM(amount - paid) as total')
      ->value('total') ?? 0;



    return view('admin.pages.dashboard', [
      'activeRegistrations' => $activeRegistrations,
      'expiredToday' => $expiredToday,
      'expiredTotal' => $expiredTotal,
      'currentIncome' => $currentIncome,
      'outstandingDebts' => $outstandingDebts
    ]);
  }
}
