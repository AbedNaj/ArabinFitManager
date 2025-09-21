<?php

namespace App\Console\Commands\SuperAdmin;

use App\Models\PermissionList;
use Illuminate\Console\Command;
use App\Enums\SuperAdmin\Permissions;
use App\Models\Feature;

class PermissionsSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:permissions-sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sync permissions from code to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $enumFeatures = collect(Permissions::cases())->map(fn($f) => $f->value)->toArray();


        foreach (Permissions::cases() as $feature) {
            $createdFeature = Feature::updateOrCreate(
                ['code' => $feature->value],
                [
                    'name' => $feature->name(),
                    'description' => $feature->description(),
                ]
            );
            foreach ($feature->permissions() as $permission) {
                PermissionList::updateOrCreate(
                    ['name' => is_array($permission) ? $permission['name'] : $permission],
                    [
                        'description' => is_array($permission) && isset($permission['description']) ? $permission['description'] : null,
                        'sort' => is_array($permission) && isset($permission['sort']) ? $permission['sort'] : 0,
                        'feature_id' => $createdFeature->id,
                    ]
                );
            }
        }

        Feature::whereNotIn('code', $enumFeatures)->delete();

        $this->info("Permissions synced successfully.");
    }
}
