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

            // Πελάτης
            $table->foreignId('customer_id')
                ->constrained()
                ->cascadeOnDelete();

            // Λόγος ραντεβού (dropdown)
            $table->string('reason'); // π.χ. "Ομαδικό ασφαλιστικό"

            // Ελεύθερο κείμενο για λεπτομέρειες
            $table->text('reason_detail')->nullable();

            // Ημερομηνία & ώρα
            $table->date('date');
            $table->time('time');

            // Μέρος
            $table->string('location')->nullable();

            // Κατάσταση (dropdown)
            $table->string('status')->default('Σε αναμονή απάντησης');

            // Για ποια ασφαλιστική μιλήσαμε (Interamerican, Groupama)
            $table->string('insurance_company')->nullable();

            $table->timestamps();

            $table->index(['date', 'time']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
