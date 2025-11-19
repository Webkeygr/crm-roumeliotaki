<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->id();

            // Βασικά στοιχεία συμβολαίου
            $table->string('contract_type');          // Ατομικό, Οικογενειακό, Ομαδικό
            $table->string('insurance_company');      // Interamerican, Groupama
            $table->string('policy_number')->unique();

            // Υπογραφή
            $table->boolean('is_signed')->default(false);
            $table->date('signed_at')->nullable();

            // Πληρωμές
            $table->string('payment_frequency');      // Μηνιαίο, Τρίμηνο, Εξάμηνο, Ετήσιο
            $table->decimal('net_value', 10, 2)->nullable();

            // Είδος συμβολαίου (ασφάλεια υγείας, ζωής κλπ)
            $table->string('policy_kind');

            // Σχέσεις
            $table->foreignId('policyholder_id')      // Συμβαλλόμενος (ένας πελάτης)
                  ->constrained('customers')
                  ->cascadeOnDelete();

            $table->foreignId('company_id')           // Εταιρία (για ομαδικά κλπ) – προαιρετικό
                  ->nullable()
                  ->constrained('companies')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('policies');
    }
};
