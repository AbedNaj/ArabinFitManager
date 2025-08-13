<?php

namespace App\Models\Tenants;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\DebtFactory> */
    use HasFactory;
    protected $guarded = ['id'];
    public function customer()
    {

        return $this->belongsTo(Customer::class);
    }
    public function registration()
    {

        return $this->belongsTo(Registration::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
