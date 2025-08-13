<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\Tenants\PaymentFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function registration()
    {
        $this->belongsTo(Registration::class);
    }
    public function customer()
    {
        $this->belongsTo(Customer::class);
    }
    public function debt()
    {
        $this->belongsTo(Debt::class);
    }
}
