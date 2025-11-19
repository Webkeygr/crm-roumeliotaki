<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_insured_customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id'); // Συμβόλαιο
            $table->unsignedBigInteger('customer_id'); // Ασφαλιζόμενος
            $table->boolean('is_primary')->default(false); // προαιρετικό
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_insured_customers');
    }
};
