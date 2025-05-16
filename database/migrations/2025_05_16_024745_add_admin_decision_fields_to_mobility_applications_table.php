<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('mobility_applications', function (Blueprint $table) {
            $table->enum('admin_approval_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('admin_approver_name')->nullable();
            $table->date('admin_approval_date')->nullable();
            $table->text('admin_rejection_reason')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('mobility_applications', function (Blueprint $table) {
            $table->dropColumn([
                'admin_approval_status',
                'admin_approver_name',
                'admin_approval_date',
                'admin_rejection_reason',
            ]);
        });
    }
};

