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
        Schema::create('inbound_students', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('university_origin');
            $table->string('program');
            $table->string('program_type');
            $table->string('responsible_lecturer');
            $table->unsignedInteger('duration_value');
            $table->string('duration_unit');
            $table->string('received_date');
            $table->string('departure_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inbound_students');
    }
};
