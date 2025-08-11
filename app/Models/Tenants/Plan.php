<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\PlanFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function registrations()
    {

        return $this->hasMany(Registration::class);
    }
}
