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
            $table->string('admin_reviewer_name')->nullable();
            $table->date('admin_reviewed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('mobility_applications', function (Blueprint $table) {
            $table->dropColumn([
                'admin_approval_status',
                'admin_rejection_reason',
                'admin_reviewer_name',
                'admin_reviewed_at',
            ]);
        });
    }
};
