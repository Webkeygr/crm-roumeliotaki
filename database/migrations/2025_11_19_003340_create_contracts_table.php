<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();

            $table->string('contract_type');          // group, individual, family
            $table->string('insurance_company');      // Interamerican, Groupama
            $table->string('contract_number')->unique();
            $table->boolean('is_signed')->default(false);
            $table->date('signed_at')->nullable();

            $table->string('payment_frequency');      // monthly, quarterly, semiannual, annual
            $table->decimal('net_value', 10, 2)->nullable();

            $table->string('contract_category');      // group_insurance, health, life, car, home

            $table->unsignedBigInteger('policy_holder_id'); // συμβαλλόμενος (Customer)
            $table->unsignedBigInteger('company_id')->nullable(); // εταιρία για ομαδικά συμβόλαια

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
