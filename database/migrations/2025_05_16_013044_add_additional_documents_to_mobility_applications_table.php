<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('mobility_applications', function (Blueprint $table) {
            $table->string('academic_transcript')->nullable();
            $table->string('acceptance_letter')->nullable();
            $table->string('proof_of_sponsorship')->nullable();
            $table->string('insurance_document')->nullable();
            $table->string('flight_ticket')->nullable();
        });
    }

    public function down()
    {
        Schema::table('mobility_applications', function (Blueprint $table) {
            $table->dropColumn([
                'academic_transcript',
                'acceptance_letter',
                'proof_of_sponsorship',
                'insurance_document',
                'flight_ticket',
            ]);
        });
    }

};
