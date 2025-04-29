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
        Schema::create('mobility_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Student ID

            // Section 1: Personal Information
            $table->string('full_name');
            $table->string('matric_no');
            $table->string('passport_no')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('kulliyyah');
            $table->string('programme');
            $table->string('cgpa');
            $table->date('date_of_birth')->nullable();
            $table->string('nationality');
            $table->string('gender');

            // Section 2: Emergency Contact
            $table->string('emergency_name');
            $table->string('emergency_relationship');
            $table->string('emergency_address');
            $table->string('emergency_phone');
            $table->string('emergency_email');

            // Section 3: Academic Background
            $table->string('home_university')->default('IIUM');
            $table->string('field_of_study');
            $table->integer('years_of_study')->nullable();
            $table->string('current_level'); // eg. UG / PG

            // Section 4: Language Proficiency
            $table->string('english_proficiency')->nullable();
            $table->string('other_languages')->nullable();

            // Section 5: Financial Information
            $table->string('sponsorship_status'); // Self/Scholarship/etc
            $table->string('sponsor_name')->nullable();
            $table->decimal('estimated_budget', 10, 2)->nullable();

            // Section 6: Mobility Programme Information
            $table->string('host_university');
            $table->string('country');
            $table->string('programme_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('programme_type'); // eg. Semester Exchange, Research, Internship, etc

            // Section 7: Student Declaration
            $table->text('declaration_text')->nullable();
            $table->boolean('agreed')->default(false);

            // Files (optional uploads)
            $table->json('supporting_documents')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobility_applications');
    }
};
