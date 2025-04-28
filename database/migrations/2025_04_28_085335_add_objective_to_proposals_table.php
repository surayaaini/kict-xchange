<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->text('objective')->nullable()->after('end_date');
            $table->json('responsible_staff')->nullable();
            $table->json('lecturers')->nullable();
            $table->json('students')->nullable();
            $table->json('documents')->nullable();
            $table->string('status')->default('Pending');
        });
    }

    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn([
                'objective',
                'responsible_staff',
                'lecturers',
                'students',
                'documents',
                'status',
            ]);
        });
    }
};
