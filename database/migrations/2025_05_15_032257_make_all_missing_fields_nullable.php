<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mobility_applications', function (Blueprint $table) {
            $table->string('phone')->nullable()->change();
            $table->string('university')->nullable()->change();
            $table->string('sponsorship_status')->nullable()->change();
            $table->string('programme_name')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('mobility_applications', function (Blueprint $table) {
            $table->string('phone')->nullable(false)->change();
            $table->string('university')->nullable(false)->change();
            $table->string('sponsorship_status')->nullable(false)->change();
            $table->string('programme_name')->nullable(false)->change();
        });
    }
};

