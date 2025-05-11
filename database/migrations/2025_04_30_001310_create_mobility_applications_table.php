<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobility_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('proposal_id')->nullable();
            $table->string('full_name');
            $table->string('matric_no');
            $table->string('email');
            $table->string('phone');
            $table->string('emergency_name');
            $table->string('emergency_phone');
            $table->string('emergency_relationship');
            $table->string('university');
            $table->string('kulliyyah');
            $table->string('cgpa');
            $table->string('language_proficiency')->nullable();
            $table->string('sponsorship_status');
            $table->string('estimated_cost')->nullable();
            $table->date('mobility_start_date');
            $table->date('mobility_end_date');
            $table->string('programme_name');
            $table->text('purpose');
            $table->boolean('declaration_agreed')->default(false);
            $table->json('supporting_files')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobility_applications');
    }
};
