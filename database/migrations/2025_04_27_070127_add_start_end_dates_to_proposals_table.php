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
        Schema::table('proposals', function (Blueprint $table) {
            $table->date('start_date')->after('responsible_staff');
            $table->date('end_date')->after('start_date');
            $table->dropColumn('duration');
        });
    }

    public function down()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->string('duration')->nullable();
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
    }


};
