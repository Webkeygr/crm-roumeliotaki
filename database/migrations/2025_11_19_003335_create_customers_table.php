<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');              // Όνομα
            $table->string('last_name');               // Επώνυμο
            $table->string('address')->nullable();     // Διεύθυνση
            $table->date('birth_date')->nullable();    // Ημ. Γέννησης
            $table->string('phone_landline')->nullable();
            $table->string('phone_mobile')->nullable();
            $table->string('marital_status')->nullable();   // single, married κλπ
            $table->string('role_in_family')->nullable();   // father, mother, child κλπ
            $table->unsignedBigInteger('company_id')->nullable(); // σε ποια εταιρία εργάζεται
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
