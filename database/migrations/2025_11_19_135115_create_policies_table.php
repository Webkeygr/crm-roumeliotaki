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
        Schema::create('policies', function (Blueprint $table) {
            $table->id();

            // Συσχέτιση με πελάτη και εταιρία (προαιρετικά / nullable)
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();

            // Βασικά στοιχεία συμβολαίου
            $table->string('policy_number')->unique();          // Αρ. συμβολαίου
            $table->string('policy_type')->nullable();          // Τύπος (Αυτοκίνητο, Υγείας κλπ)
            $table->string('insurance_company')->nullable();    // Ασφαλιστική εταιρία

            // Ημερομηνίες
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Οικονομικά
            $table->decimal('annual_premium', 10, 2)->nullable(); // Ετήσιο ασφάλιστρο
            $table->string('payment_frequency')->nullable();      // π.χ. Ετήσια, Εξαμηνιαία κλπ

            // Κατάσταση συμβολαίου
            $table->string('status')->default('active');          // active, expired, cancelled κλπ

            // Σημειώσεις
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policies');
    }
};
