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
            $table->string('host_institution')->nullable()->after('mobility_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('mobility_applications', function (Blueprint $table) {
            $table->dropColumn('host_institution');
        });
    }
};
