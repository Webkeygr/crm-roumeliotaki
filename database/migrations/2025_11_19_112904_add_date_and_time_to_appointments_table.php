<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('appointments', function (Blueprint $table) {
        if (!Schema::hasColumn('appointments', 'date')) {
            $table->date('date')->nullable();
        }

        if (!Schema::hasColumn('appointments', 'time')) {
            $table->time('time')->nullable();
        }
    });
}

public function down()
{
    Schema::table('appointments', function (Blueprint $table) {
        if (Schema::hasColumn('appointments', 'date')) {
            $table->dropColumn('date');
        }

        if (Schema::hasColumn('appointments', 'time')) {
            $table->dropColumn('time');
        }
    });
}

};
