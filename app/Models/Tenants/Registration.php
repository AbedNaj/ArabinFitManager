<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\RegistrationFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function customer()
    {

        return $this->belongsTo(Customer::class);
    }

    public function plan()
    {

        return $this->belongsTo(Plan::class);
    }

    public function debt()
    {

        return $this->hasOne(Debt::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
