<?php

use App\Models\Tenants\Customer;
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
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Registration::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Customer::class)->nullable()->constrained()->nullOnDelete();
            $table->string('name')->nullable();
            $table->decimal('amount', 10, 2);
            $table->decimal('paid', 10, 2)->default(0);
            $table->enum('status', ['unpaid', 'partial', 'paid', 'cancelled'])->default('unpaid');
            $table->date('debt_date')->nullable()->default(now());
            $table->date('fully_paid_at')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index(['customer_id', 'status'], 'idx_debts_customer_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts');
    }
};
