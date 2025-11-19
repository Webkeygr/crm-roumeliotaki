<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_relations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');         // κύριος πελάτης
            $table->unsignedBigInteger('related_customer_id'); // μέλος οικογένειας
            $table->string('relation_type')->nullable();       // spouse, child, parent κλπ.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_relations');
    }
};
