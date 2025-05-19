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
        Schema::table('inbound_students', function (Blueprint $table) {
            $table->date('received_date')->change();
            $table->date('departure_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inbound_students', function (Blueprint $table) {
            $table->string('received_date')->change();
            $table->string('departure_date')->change();
        });
    }
};
