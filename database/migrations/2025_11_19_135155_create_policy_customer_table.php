<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('policy_customer', function (Blueprint $table) {
            $table->id();

            $table->foreignId('policy_id')
                  ->constrained('policies')
                  ->cascadeOnDelete();

            $table->foreignId('customer_id')
                  ->constrained('customers')
                  ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['policy_id', 'customer_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('policy_customer');
    }
};
