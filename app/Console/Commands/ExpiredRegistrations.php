<?php

namespace App\Console\Commands;

use App\Enums\CustomerStatusEnum;
use App\Enums\RegistrationStatusEnum;
use App\Models\Tenants\Customer;
use App\Models\Tenants\Registration;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpiredRegistrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registration:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update registration status to expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $query = Registration::where('status', RegistrationStatusEnum::ACTIVE->value)
            ->whereDate('end_date', '<=', Carbon::today());


        $customerIds = $query->pluck('customer_id')->unique();


        $updated = $query->update(['status' => RegistrationStatusEnum::EXPIRED->value]);


        if ($updated > 0 && $customerIds->isNotEmpty()) {
            Customer::whereIn('id', $customerIds)
                ->whereDoesntHave('registrations', function ($q) {
                    $q->where('status', RegistrationStatusEnum::ACTIVE->value);
                })
                ->update(['status' => CustomerStatusEnum::NOT_REGISTERED->value]);
        }

        $this->info("Expired $updated registrations and updated related customers where applicable.");
    }
}
