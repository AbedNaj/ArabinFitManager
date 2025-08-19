<?php

namespace App\Console\Commands;

use App\Enums\RegistrationStatusEnum;
use App\Models\Tenants\Registration;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ActiveRegistrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registration:active';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update registration status to active';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $query = Registration::where('status', RegistrationStatusEnum::WAITING->value)
            ->whereDate('start_date', '<=', Carbon::today());





        $updated = $query->update(['status' => RegistrationStatusEnum::ACTIVE->value]);



        $this->info("Expired $updated registrations and updated related customers where applicable.");
    }
}
