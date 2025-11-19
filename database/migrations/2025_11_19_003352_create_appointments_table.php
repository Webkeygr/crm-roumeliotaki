<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('customer_id')->nullable(); // Πελάτης
            $table->unsignedBigInteger('company_id')->nullable();  // Εταιρία (αν αφορά εταιρία)

            $table->string('reason_type');              // group_insurance, health, life, car, home
            $table->text('reason_details')->nullable(); // περιγραφή ραντεβού

            $table->date('appointment_date');
            $table->time('appointment_time')->nullable();
            $table->string('location')->nullable();     // Μέρος

            $table->string('status');                   // cancelled, awaiting_response, application, contract_signing
            $table->string('discussed_company')->nullable(); // Interamerican, Groupama κλπ.

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
