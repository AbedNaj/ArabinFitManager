<?php

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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique('uq_customers_name');
            $table->fullText('name', 'ft_customers_name');
            $table->string('phone')->nullable();
            $table->enum('status', ['registered', 'not_registered'])->default('not_registered');
            $table->timestamps();
            $table->index('status', 'idx_customers_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
