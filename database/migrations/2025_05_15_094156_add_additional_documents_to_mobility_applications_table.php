<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('mobility_applications', function (Blueprint $table) {
            $table->string('invitation_letter_file')->nullable()->after('indemnity_file');
            $table->string('sponsorship_proof_file')->nullable()->after('invitation_letter_file');
            $table->string('transcript_file')->nullable()->after('sponsorship_proof_file');
            $table->string('insurance_file')->nullable()->after('transcript_file');
            $table->string('flight_ticket_file')->nullable()->after('insurance_file');
        });
    }

    public function down(): void
    {
        Schema::table('mobility_applications', function (Blueprint $table) {
            $table->dropColumn([
                'invitation_letter_file',
                'sponsorship_proof_file',
                'transcript_file',
                'insurance_file',
                'flight_ticket_file',
            ]);
        });
    }
};
