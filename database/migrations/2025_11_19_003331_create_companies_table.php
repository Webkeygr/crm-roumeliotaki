<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('business_activity')->nullable();   // Αντικείμενο Επιχείρησης
            $table->unsignedBigInteger('contact_customer_id')->nullable(); // θα το συνδέσουμε λογικά με Customer
            $table->string('contact_position')->nullable();  // Θέση
            $table->integer('staff_size_exact')->nullable(); // ακριβής αριθμός
            $table->integer('staff_size_range_from')->nullable(); // "από"
            $table->integer('staff_size_range_to')->nullable();   // "έως"
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
