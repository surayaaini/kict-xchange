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
            // Only modify if column exists (avoid crashes)
            if (Schema::hasColumn('mobility_applications', 'phone')) {
                $table->string('phone')->nullable()->change();
            }

            if (Schema::hasColumn('mobility_applications', 'university')) {
                $table->string('university')->nullable()->change();
            }

            // Add more fields here if more errors come up
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
