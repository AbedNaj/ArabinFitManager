<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\CustomerFactory> */
    use HasFactory;

    protected $guarded = ['id'];


    public function registrations()
    {

        return $this->hasMany(Registration::class);
    }
    public function latestRegistration()
    {
        return $this->hasOne(Registration::class)->latestOfMany();
    }
    public function debts()
    {
        return $this->hasMany(Debt::class);
    }
}
