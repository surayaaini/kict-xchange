<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            if (!Schema::hasColumn('proposals', 'responsible_staff')) {
                $table->json('responsible_staff')->nullable();
            }
            if (!Schema::hasColumn('proposals', 'lecturers')) {
                $table->json('lecturers')->nullable();
            }
            if (!Schema::hasColumn('proposals', 'students')) {
                $table->json('students')->nullable();
            }
            if (!Schema::hasColumn('proposals', 'documents')) {
                $table->json('documents')->nullable();
            }
            if (!Schema::hasColumn('proposals', 'status')) {
                $table->string('status')->default('Pending');
            }
        });
    }

    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn([
                'responsible_staff',
                'lecturers',
                'students',
                'documents',
                'status',
            ]);
        });
    }
};
