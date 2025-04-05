<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mou_moas', function (Blueprint $table) {
            $table->string('collaborator')->after('id'); // You can adjust the position
        });
    }

    public function down(): void
    {
        Schema::table('mou_moas', function (Blueprint $table) {
            $table->dropColumn('collaborator');
        });
    }


};
