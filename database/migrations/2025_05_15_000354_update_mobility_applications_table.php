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
        Schema::table('mobility_applications', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable();
            $table->text('home_address')->nullable();
            $table->text('mailing_address')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('nationality')->nullable();
            $table->string('passport_no')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->string('passport_copy')->nullable();

            $table->string('emergency_email')->nullable();
            $table->text('emergency_address')->nullable();

            $table->string('level_of_study')->nullable(); // UG/PG
            $table->tinyInteger('year_of_study')->nullable();
            $table->tinyInteger('semester')->nullable();

            $table->string('fully_funded')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('sponsoring_amount')->nullable();

            $table->string('mobility_type')->nullable(); // Physical/Virtual

            $table->string('responsible_staff_name')->nullable();
            $table->string('responsible_staff_email')->nullable();
            $table->string('responsible_staff_position')->nullable();

            $table->string('student_declaration_name')->nullable();
            $table->string('student_declaration_matric')->nullable();
            $table->date('student_declaration_date')->nullable();
            $table->string('indemnity_file')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mobility_applications', function (Blueprint $table) {
            //
        });
    }
};
