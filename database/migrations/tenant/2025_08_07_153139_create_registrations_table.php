<?php

use App\Models\Tenants\Customer;
use App\Models\Tenants\Plan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Plan::class)->nullable()->constrained()->nullOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('price_at_signup', 10, 2)->nullable();
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])->default('unpaid');
            $table->enum('status', ['waiting', 'active', 'expired', 'freezed', 'stopped'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
