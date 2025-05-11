<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('proposals', function (Blueprint $table) {
            $table->json('students')->nullable()->change();
            $table->json('lecturers')->nullable()->change();
        });
    }

    public function down(): void {
        // Optional rollback logic
    }
};
