<?php

use App\Models\Tenants\Customer;
use App\Models\Tenants\Debt;
use App\Models\Tenants\Registration;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Registration::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Debt::class)->nullable()->constrained()->nullOnDelete();
            $table->decimal('amount', 10, 2);
            $table->timestamps();

            $table->index(['customer_id', 'created_at'], 'idx_pay_customer_date');
            $table->index('registration_id', 'idx_pay_registration');
            $table->index('debt_id', 'idx_pay_debt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
